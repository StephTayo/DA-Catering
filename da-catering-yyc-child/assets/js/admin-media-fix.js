/* Media library upload UX fix: refresh grid on success, clear false error */
(function ($) {
  if (!window.wp) {
    return;
  }

  const forceGridLoad = () => {
    try {
      if (wp.media && wp.media.view && wp.media.view.MediaFrame && wp.media.library) {
        wp.media.library.init();
      }
      if (wp.media && wp.media.frame && wp.media.frame.content && wp.media.frame.content.get) {
        const view = wp.media.frame.content.get();
        if (view && view.collection && view.collection.fetch) {
          view.collection.fetch({ reset: true, data: { per_page: 80 } });
        }
      }
      $(".media-frame .spinner, .media-frame .attachments-browser").removeClass("is-loading");
      $(".media-frame .attachments-browser").attr("aria-busy", "false");
    } catch (e) {
      // ignore
    }
  };

  const refreshLibrary = () => {
    if (wp.media && wp.media.frame && wp.media.frame.content && wp.media.frame.content.get) {
      const view = wp.media.frame.content.get();
      if (view && view.collection && view.collection.fetch) {
        view.collection.fetch({ reset: true });
      }
    }
    if (wp.media && wp.media.library && wp.media.library.init) {
      wp.media.library.init();
    }
  };

  const clearFalseErrors = () => {
    $(".upload-error, .media-modal .error, .notice-error").each(function () {
      const text = $(this).text() || "";
      if (text.toLowerCase().includes("error occurred in the upload")) {
        $(this).remove();
      }
    });
  };

  if (wp.Uploader && wp.Uploader.queue) {
    wp.Uploader.queue.on("FileUploaded", function (up, file, response) {
      try {
        const data = response && response.response ? JSON.parse(response.response) : null;
        if (data && data.success) {
          clearFalseErrors();
          refreshLibrary();
        }
      } catch (e) {
        // ignore parse errors
      }
    });

    wp.Uploader.queue.on("UploadComplete", function () {
      setTimeout(function () {
        clearFalseErrors();
        refreshLibrary();
      }, 500);
    });
  }

  $(document).ajaxComplete(function (_evt, xhr, settings) {
    if (!settings || !settings.data) return;
    if (settings.url && settings.url.indexOf("upload-attachment") !== -1) {
      clearFalseErrors();
      refreshLibrary();
    }
  });

  // Customizer media frame: re-fetch when opened from controls.
  $(document).on("click", ".customize-control .upload-button, .customize-control .button", function () {
    setTimeout(function () {
      clearFalseErrors();
      refreshLibrary();
    }, 400);
  });

  // Fallback: clean up any lingering false error banners.
  setInterval(clearFalseErrors, 1500);

  $(document).ready(function () {
    setTimeout(forceGridLoad, 300);
    setTimeout(forceGridLoad, 1500);
  });
})(jQuery);
