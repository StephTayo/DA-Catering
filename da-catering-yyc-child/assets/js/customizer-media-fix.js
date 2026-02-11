/* Customizer media modal fix: force library fetch and clear loading state */
(function ($) {
  const wpRoot = window.wp || (window.parent && window.parent.wp);
  const wpMedia = wpRoot && wpRoot.media ? wpRoot.media : null;
  if (!wpMedia) {
    return;
  }

  const fixApiSettings = () => {
    if (!window.wpApiSettings) {
      window.wpApiSettings = {};
    }
    if (window.daMediaFix && daMediaFix.restUrl && !window.wpApiSettings.root) {
      window.wpApiSettings.root = daMediaFix.restUrl;
    }
    if (window.daMediaFix && daMediaFix.restNonce && !window.wpApiSettings.nonce) {
      window.wpApiSettings.nonce = daMediaFix.restNonce;
    }
    if (wpMedia.settings) {
      wpMedia.settings.ajaxurl = (daMediaFix && daMediaFix.ajaxUrl) || wpMedia.settings.ajaxurl;
      wpMedia.settings.post = wpMedia.settings.post || { id: 0 };
    }
    if (wpMedia.view && wpMedia.view.settings) {
      wpMedia.view.settings.ajaxurl = (daMediaFix && daMediaFix.ajaxUrl) || wpMedia.view.settings.ajaxurl;
      wpMedia.view.settings.post = wpMedia.view.settings.post || { id: 0 };
    }
  };

  const forceQuerySync = () => {
    if (!wpMedia.model || !wpMedia.model.Query || wpMedia.model.Query.__daMediaPatched) {
      return;
    }
    const originalSync = wpMedia.model.Query.prototype.sync;
    wpMedia.model.Query.prototype.sync = function (method, model, options) {
      if (method !== "read" || !window.daMediaFix || !daMediaFix.ajaxUrl) {
        return originalSync.call(this, method, model, options);
      }
      const data = $.extend(true, {}, model.toJSON(), {
        _wpnonce: daMediaFix.mediaNonce,
        nonce: daMediaFix.mediaNonce,
        action: "query-attachments",
      });
      return $.post(daMediaFix.ajaxUrl, data)
        .done(function (resp) {
          let items = [];
          if (resp && resp.success && Array.isArray(resp.data)) {
            items = resp.data;
          } else if (Array.isArray(resp)) {
            items = resp;
          }
          if (items.length) {
            options.success(items);
          } else if (resp && resp.success) {
            options.success([]);
          } else {
            options.error(resp);
          }
        })
        .fail(function (xhr) {
          options.error(xhr);
        });
    };
    wpMedia.model.Query.__daMediaPatched = true;
  };

  const patchAttachmentsParse = () => {
    if (!wpMedia.model || !wpMedia.model.Attachments || wpMedia.model.Attachments.__daParsePatched) {
      return;
    }
    const originalParse = wpMedia.model.Attachments.prototype.parse;
    wpMedia.model.Attachments.prototype.parse = function (resp, xhr) {
      if (resp && resp.success && Array.isArray(resp.data)) {
        return resp.data;
      }
      return originalParse.call(this, resp, xhr);
    };
    wpMedia.model.Attachments.__daParsePatched = true;
  };

  const refreshFrame = (frame) => {
    try {
      if (frame && frame.content) {
        frame.content.mode("browse");
      }
      if (frame && frame.library && frame.library.props) {
        frame.library.props.set({ orderby: "date", order: "DESC" });
      }
      if (frame && frame.library && frame.library.more) {
        frame.library.more();
      }
      if (frame && frame.collection && frame.collection.fetch) {
        frame.collection.fetch({ reset: true });
      }
      $(".media-frame .spinner, .media-frame .attachments-browser").removeClass("is-loading");
      $(".media-frame .attachments-browser").attr("aria-busy", "false");
    } catch (e) {
      // ignore
    }
  };

  const hydrateWithAjax = (frame) => {
    if (!window.daMediaFix || !daMediaFix.ajaxUrl) {
      return;
    }
    $.post(daMediaFix.ajaxUrl, {
      action: "query-attachments",
      _wpnonce: daMediaFix.mediaNonce,
      nonce: daMediaFix.mediaNonce,
      posts_per_page: 80,
      paged: 1,
      order: "DESC",
      orderby: "date",
    }).done(function (resp) {
      const items = resp && resp.success && Array.isArray(resp.data) ? resp.data : (Array.isArray(resp) ? resp : []);
      if (!items.length) return;
      const models = items.map((item) => wpMedia.model.Attachment.create(item));
      const state = frame && frame.state ? frame.state() : null;
      const library = state && state.get ? state.get("library") : null;
      if (library) {
        library.reset(models);
        library.trigger("reset");
      }
      const view = frame && frame.content && frame.content.get ? frame.content.get("browse") : null;
      if (view) {
        if (view.collection) {
          view.collection.reset(models);
          view.collection.trigger("reset");
        }
        if (view.render) {
          view.render();
        }
      }
      $(".media-frame .spinner, .media-frame .attachments-browser").removeClass("is-loading");
      $(".media-frame .attachments-browser").attr("aria-busy", "false");
    });
  };

  const getActiveFrame = () => {
    if (wpMedia.frame) return wpMedia.frame;
    if (wpMedia.editor && wpMedia.editor.frame) return wpMedia.editor.frame;
    if (wpMedia.frames) {
      return (
        wpMedia.frames.select ||
        wpMedia.frames.media ||
        wpMedia.frames.default ||
        wpMedia.frames.custom ||
        null
      );
    }
    return null;
  };

  $(document).on("click", ".customize-control .upload-button, .customize-control .button", function () {
    setTimeout(function () {
      const frame = getActiveFrame();
      if (frame) {
        fixApiSettings();
        forceQuerySync();
        patchAttachmentsParse();
        refreshFrame(frame);
        setTimeout(function () {
          const isLoading = $(".media-frame .attachments-browser.is-loading").length > 0;
          if (isLoading) {
            hydrateWithAjax(frame);
          }
        }, 800);
      } else {
        // Force a media query to kick-start the library loader.
        fixApiSettings();
        forceQuerySync();
        patchAttachmentsParse();
        try {
          const collection = wpMedia.query({
            type: "image",
            per_page: 80,
            order: "DESC",
            orderby: "date",
          });
          collection.more();
        } catch (e) {
          // ignore
        }
      }
    }, 300);
  });

  $(document).ajaxComplete(function (_evt, _xhr, settings) {
    if (!settings || !settings.data) return;
    if (settings.url && settings.url.indexOf("query-attachments") !== -1) {
      const frame = getActiveFrame();
      if (frame) {
        fixApiSettings();
        refreshFrame(frame);
      }
    }
  });
})(jQuery);
