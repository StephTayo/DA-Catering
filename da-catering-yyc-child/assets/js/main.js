const orderKey = "daCateringOrder";

const formatCurrency = (value) => {
  const number = Number(value);
  if (Number.isNaN(number)) return value;
  return `$${number.toFixed(2)}`;
};

const getStoredOrder = () => {
  try {
    return JSON.parse(localStorage.getItem(orderKey)) || [];
  } catch {
    return [];
  }
};

const saveOrder = (items) => {
  localStorage.setItem(orderKey, JSON.stringify(items));
};

const updateQtyDisplay = (wrapper, qty) => {
  const display = wrapper.querySelector("[data-qty-display]");
  if (display) {
    display.textContent = qty;
  }
};

const buildWhatsAppMessage = (items, context) => {
  if (!items.length) {
    return context === "booking"
      ? "Hi DA Catering YYC, I would like to book catering for my event."
      : "Hi DA Catering YYC, I would like to place an order.";
  }

  const lines = items.map((item) => {
    const notes = item.notes ? ` (Notes: ${item.notes})` : "";
    return `- ${item.name} x${item.qty}${notes}`;
  });

  const intro = context === "booking"
    ? "Hi DA Catering YYC, I would like to book catering. Here is what I have in mind:"
    : "Hi DA Catering YYC, I would like to place an order. Here are my items:";

  return `${intro}\n${lines.join("\n")}`;
};

const renderBookingOrderSummary = (items, container) => {
  container.innerHTML = "";

  if (!items.length) {
    const menuLink = `${window.location.origin}/#menu`;
    container.innerHTML = `<p class="booking-empty">Your order is empty. <a href="${menuLink}" class="booking-link">Browse our menu</a> to add items.</p>`;
    return;
  }

  let subtotal = 0;
  items.forEach((item, index) => {
    const price = Number(item.price);
    const lineTotal = price * item.qty;
    subtotal += lineTotal;

    const row = document.createElement("div");
    row.className = "order-item";
    row.innerHTML = `
      <div class="order-item-info">
        <div class="order-item-title">${item.name}</div>
        ${item.notes ? `<div class="order-item-notes">Notes: ${item.notes}</div>` : ""}
      </div>
      <div class="order-item-actions">
        <div class="order-qty">
          <button type="button" class="order-qty-btn" data-qty-action="minus" data-idx="${index}">-</button>
          <span class="order-qty-value">${item.qty}</span>
          <button type="button" class="order-qty-btn" data-qty-action="plus" data-idx="${index}">+</button>
        </div>
        <div class="order-item-price">${formatCurrency(lineTotal)}</div>
        <button type="button" class="order-remove" data-qty-action="remove" data-idx="${index}">Remove</button>
      </div>
    `;
    container.appendChild(row);
  });

  const total = document.createElement("div");
  total.className = "order-item order-total";
  total.innerHTML = `<span>Estimated subtotal</span><span>${formatCurrency(subtotal)}</span>`;
  container.appendChild(total);
};

const updateOrderSummary = () => {
  const container = document.querySelector("[data-order-summary]");
  if (!container) return;

  const items = getStoredOrder();
  const isBooking = document.body.classList.contains("booking-page");

  if (isBooking) {
    renderBookingOrderSummary(items, container);
  } else {
    container.innerHTML = "";

    if (!items.length) {
      container.innerHTML = "<p>Your selected items will appear here. Add dishes from the menu to build your order.</p>";
      return;
    }

    let subtotal = 0;
    items.forEach((item) => {
      const price = Number(item.price);
      subtotal += price * item.qty;

      const row = document.createElement("div");
      row.className = "order-item";
      row.innerHTML = `
        <span>${item.name} x${item.qty}</span>
        <span>${formatCurrency(price * item.qty)}</span>
      `;
      container.appendChild(row);
    });

    const total = document.createElement("div");
    total.className = "order-item order-total";
    total.innerHTML = `<span>Estimated subtotal</span><span>${formatCurrency(subtotal)}</span>`;
    container.appendChild(total);
  }

  const whatsappLink = document.querySelector("[data-order-whatsapp]");
  if (whatsappLink) {
    const message = encodeURIComponent(buildWhatsAppMessage(items, "order"));
    whatsappLink.href = `https://wa.me/14034782475?text=${message}`;
  }
};

const initMenuActions = () => {
  const cards = document.querySelectorAll("[data-product]");
  if (!cards.length) return;

  cards.forEach((card) => {
    let qty = 1;
    const minus = card.querySelector("[data-qty-minus]");
    const plus = card.querySelector("[data-qty-plus]");
    const addBtn = card.querySelector("[data-add-item]");
    const notesInput = card.querySelector("[data-notes]");

    updateQtyDisplay(card, qty);

    if (minus) {
      minus.addEventListener("click", () => {
        qty = Math.max(1, qty - 1);
        updateQtyDisplay(card, qty);
      });
    }

    if (plus) {
      plus.addEventListener("click", () => {
        qty += 1;
        updateQtyDisplay(card, qty);
      });
    }

    if (addBtn) {
      addBtn.addEventListener("click", () => {
        const name = card.getAttribute("data-name");
        const price = card.getAttribute("data-price") || "0";
        const notes = notesInput ? notesInput.value.trim() : "";

        const items = getStoredOrder();
        const existing = items.find((item) => item.name === name && item.notes === notes);
        if (existing) {
          existing.qty += qty;
        } else {
          items.push({ name, price, qty, notes });
        }
        saveOrder(items);
        addBtn.textContent = "Added";
        setTimeout(() => (addBtn.textContent = "Add to Order"), 1200);
        window.location.href = `${window.location.origin}/booking/#checkout`;
      });
    }
  });
};

const initFilters = () => {
  const buttons = document.querySelectorAll("[data-filter]");
  const cards = document.querySelectorAll("[data-category]");
  if (!buttons.length || !cards.length) return;

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      buttons.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");
      const target = btn.getAttribute("data-filter");
      cards.forEach((card) => {
        if (target === "all" || card.getAttribute("data-category").includes(target)) {
          card.style.display = "flex";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
};

const initMobileMenu = () => {
  const toggle = document.querySelector("[data-mobile-toggle]");
  const nav = document.querySelector("[data-nav]");
  const actions = document.querySelector("[data-actions]");
  if (!toggle || !nav || !actions) return;

  toggle.addEventListener("click", () => {
    nav.classList.toggle("mobile-open");
    actions.classList.toggle("mobile-open");
    toggle.classList.toggle("active");
  });

  nav.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      nav.classList.remove("mobile-open");
      actions.classList.remove("mobile-open");
      toggle.classList.remove("active");
    });
  });

  document.addEventListener("click", (event) => {
    if (toggle.contains(event.target) || nav.contains(event.target) || actions.contains(event.target)) {
      return;
    }
    nav.classList.remove("mobile-open");
    actions.classList.remove("mobile-open");
    toggle.classList.remove("active");
  });
};

const initCarousel = () => {
  const carousels = document.querySelectorAll("[data-carousel]");
  if (!carousels.length) return;

  carousels.forEach((carousel) => {
    const track = carousel.querySelector("[data-carousel-track]");
    const prevBtn = carousel.querySelector("[data-carousel-prev]");
    const nextBtn = carousel.querySelector("[data-carousel-next]");

    if (!track || !prevBtn || !nextBtn) return;

    const getScrollAmount = () => {
      const card = track.children[0];
      if (!card) return 320;
      const gap = parseInt(getComputedStyle(track).gap || "24", 10);
      return card.getBoundingClientRect().width + gap;
    };

    prevBtn.addEventListener("click", () => {
      track.scrollBy({ left: -getScrollAmount(), behavior: "smooth" });
    });

    nextBtn.addEventListener("click", () => {
      track.scrollBy({ left: getScrollAmount(), behavior: "smooth" });
    });
  });
};

const initOrderSummary = () => {
  updateOrderSummary();
};

const initDragScroll = () => {
  const tracks = document.querySelectorAll("[data-drag-track]");
  if (!tracks.length) return;

  tracks.forEach((track) => {
    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;

    track.addEventListener("mousedown", (event) => {
      isDown = true;
      track.classList.add("dragging");
      startX = event.pageX - track.offsetLeft;
      scrollLeft = track.scrollLeft;
    });

    track.addEventListener("mouseleave", () => {
      isDown = false;
      track.classList.remove("dragging");
    });

    track.addEventListener("mouseup", () => {
      isDown = false;
      track.classList.remove("dragging");
    });

    track.addEventListener("mousemove", (event) => {
      if (!isDown) return;
      event.preventDefault();
      const x = event.pageX - track.offsetLeft;
      const walk = (x - startX) * 1.4;
      track.scrollLeft = scrollLeft - walk;
    });
  });
};

const initDeliveryToggle = () => {
  const deliverySelect = document.querySelector("[data-delivery-toggle]");
  const deliveryFields = document.querySelectorAll("[data-delivery-field]");

  const updateVisibility = (isDelivery) => {
    deliveryFields.forEach((field) => {
      field.style.display = isDelivery ? "block" : "none";
    });
  };

  if (deliverySelect) {
    updateVisibility(deliverySelect.value === "delivery");
    deliverySelect.addEventListener("change", () => {
      updateVisibility(deliverySelect.value === "delivery");
    });
  }

  const deliveryRadios = document.querySelectorAll("input[name=\"fulfillment\"]");
  if (deliveryRadios.length) {
    const syncRadio = () => {
      const selected = document.querySelector("input[name=\"fulfillment\"]:checked");
      updateVisibility(selected && selected.value === "delivery");
    };
    syncRadio();
    deliveryRadios.forEach((radio) => {
      radio.addEventListener("change", syncRadio);
    });
  }
};

const initMenuCardFocus = () => {
  const menuTrack = document.querySelector("#menu .product-grid");
  if (!menuTrack) return;

  const originalCards = Array.from(menuTrack.querySelectorAll(".product-card"));
  const cards = [...originalCards];
  if (!cards.length) return;

  let ticking = false;
  const dotsContainer = document.querySelector("[data-menu-dots]");
  let isLooping = false;
  let cloneCount = 0;

  const buildLoopClones = () => {
    const visibleCards = getVisibleCards();
    if (visibleCards.length < 3) return;

    const computedStyle = getComputedStyle(menuTrack);
    const gap = parseInt(computedStyle.gap || "24", 10);
    const cardWidth = visibleCards[0].getBoundingClientRect().width + gap;
    cloneCount = Math.min(3, visibleCards.length);

    visibleCards.slice(0, cloneCount).forEach((card) => {
      const clone = card.cloneNode(true);
      clone.setAttribute("data-clone", "true");
      menuTrack.appendChild(clone);
      cards.push(clone);
    });

    visibleCards.slice(-cloneCount).forEach((card) => {
      const clone = card.cloneNode(true);
      clone.setAttribute("data-clone", "true");
      menuTrack.insertBefore(clone, menuTrack.firstChild);
      cards.unshift(clone);
    });

    const offset = cardWidth * cloneCount;
    menuTrack.scrollLeft = offset;
  };

  const getVisibleCards = () => cards.filter((card) => card.style.display !== "none");

  const buildDots = () => {
    if (!dotsContainer) return;
    const visibleCards = getVisibleCards();
    dotsContainer.innerHTML = "";
    visibleCards.forEach((card, index) => {
      const dot = document.createElement("button");
      dot.type = "button";
      dot.className = "menu-dot";
      dot.setAttribute("aria-label", `Go to menu item ${index + 1}`);
      dot.addEventListener("click", () => {
        if (card.getAttribute("data-clone") === "true") return;
        card.scrollIntoView({ behavior: "smooth", inline: "center", block: "nearest" });
      });
      dotsContainer.appendChild(dot);
    });
  };

  const updateActiveCard = () => {
    const trackRect = menuTrack.getBoundingClientRect();
    const centerX = trackRect.left + trackRect.width / 2;

    let closestCard = null;
    let closestDistance = Infinity;

    cards.forEach((card) => {
      if (card.style.display === "none") return;
      if (card.getAttribute("data-clone") === "true") return;
      const rect = card.getBoundingClientRect();
      const cardCenter = rect.left + rect.width / 2;
      const distance = Math.abs(centerX - cardCenter);
      if (distance < closestDistance) {
        closestDistance = distance;
        closestCard = card;
      }
    });

    cards.forEach((card) => card.classList.remove("is-active"));
    if (closestCard) {
      closestCard.classList.add("is-active");
    }

    if (dotsContainer) {
      const visibleCards = getVisibleCards();
      const activeIndex = visibleCards.indexOf(closestCard);
      dotsContainer.querySelectorAll(".menu-dot").forEach((dot, idx) => {
        dot.classList.toggle("active", idx === activeIndex);
      });
    }
  };

  const onScroll = () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (cloneCount && !isLooping) {
          const computedStyle = getComputedStyle(menuTrack);
          const gap = parseInt(computedStyle.gap || "24", 10);
          const cardWidth = originalCards[0].getBoundingClientRect().width + gap;
          const totalOriginal = cardWidth * originalCards.length;
          const totalClones = cardWidth * cloneCount;
          const scrollLeft = menuTrack.scrollLeft;

          if (scrollLeft <= totalClones - cardWidth) {
            isLooping = true;
            menuTrack.scrollLeft = scrollLeft + totalOriginal;
            isLooping = false;
          } else if (scrollLeft >= totalClones + totalOriginal) {
            isLooping = true;
            menuTrack.scrollLeft = scrollLeft - totalOriginal;
            isLooping = false;
          }
        }
        updateActiveCard();
        ticking = false;
      });
      ticking = true;
    }
  };

  menuTrack.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", updateActiveCard);

  const filterButtons = document.querySelectorAll("#menu [data-filter]");
  filterButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      setTimeout(() => {
        menuTrack.querySelectorAll("[data-clone=\"true\"]").forEach((node) => node.remove());
        cards.length = 0;
        cards.push(...Array.from(menuTrack.querySelectorAll(".product-card")));
        buildDots();
        buildLoopClones();
        updateActiveCard();
      }, 0);
    });
  });

  buildDots();
  buildLoopClones();
  updateActiveCard();
};

const initBookingTabs = () => {
  const page = document.querySelector(".booking-page");
  if (!page || page.classList.contains("booking-modern")) return;

  const buttons = page.querySelectorAll(".tab-btn");
  const contents = page.querySelectorAll(".tab-content");
  if (!buttons.length || !contents.length) return;

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const tabId = button.getAttribute("data-tab");

      buttons.forEach((btn) => btn.classList.remove("active"));
      contents.forEach((content) => content.classList.remove("active"));

      button.classList.add("active");
      const target = page.querySelector(`#${tabId}`);
      if (target) {
        target.classList.add("active");
      }
    });
  });
};

const initBookingForms = () => {
  const page = document.querySelector(".booking-page");
  if (!page || page.classList.contains("booking-modern")) return;

  const cateringForm = page.querySelector("#cateringForm");
  if (cateringForm) {
    cateringForm.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Booking request submitted! We'll contact you within 2 hours.");
    });
  }

  const checkoutForm = page.querySelector("#checkoutForm");
  if (checkoutForm) {
    checkoutForm.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Order placed successfully! Check your email for confirmation.");
    });
  }
};

const initBookingSmoothScroll = () => {
  const page = document.querySelector(".booking-page");
  if (!page || page.classList.contains("booking-modern")) return;

  page.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", (e) => {
      const target = page.querySelector(anchor.getAttribute("href"));
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: "smooth" });
    });
  });
};

const initBookingOrderControls = () => {
  const page = document.querySelector(".booking-page");
  if (!page || page.classList.contains("booking-modern")) return;

  const container = page.querySelector("[data-order-summary]");
  if (!container) return;

  container.addEventListener("click", (event) => {
    const button = event.target.closest("[data-qty-action]");
    if (!button) return;

    const action = button.getAttribute("data-qty-action");
    const index = Number(button.getAttribute("data-idx"));
    if (Number.isNaN(index)) return;

    const items = getStoredOrder();
    const item = items[index];
    if (!item) return;

    if (action === "plus") {
      item.qty += 1;
    } else if (action === "minus") {
      item.qty = Math.max(1, item.qty - 1);
    } else if (action === "remove") {
      items.splice(index, 1);
    }

    saveOrder(items);
    updateOrderSummary();
  });
};

const initSmoothiesDeck = () => {
  const deck = document.querySelector("[data-smoothies-deck]");
  if (!deck) return;

  const cards = Array.from(deck.querySelectorAll("[data-smoothie-card]"));
  if (!cards.length) return;

  const dotsContainer = document.querySelector("[data-smoothies-dots]");
  let currentIndex = 0;

  const updateActive = () => {
    cards.forEach((card, idx) => {
      card.classList.toggle("is-active", idx === currentIndex);
    });

    if (dotsContainer) {
      dotsContainer.querySelectorAll(".smoothies-dot").forEach((dot, idx) => {
        dot.classList.toggle("active", idx === currentIndex);
      });
    }
  };

  const nextCard = () => {
    currentIndex = (currentIndex + 1) % cards.length;
    updateActive();
  };

  cards.forEach((card) => {
    card.addEventListener("click", () => {
      nextCard();
    });
  });

  if (dotsContainer) {
    dotsContainer.innerHTML = "";
    cards.forEach((card, idx) => {
      const dot = document.createElement("button");
      dot.type = "button";
      dot.className = "smoothies-dot";
      dot.setAttribute("aria-label", `Show smoothie ${idx + 1}`);
      dot.addEventListener("click", (event) => {
        event.stopPropagation();
        currentIndex = idx;
        updateActive();
      });
      dotsContainer.appendChild(dot);
    });
  }

  updateActive();
};

const initSmoothiesButtons = () => {
  const buttons = document.querySelectorAll(".smoothies-sticky .btn.btn-primary");
  if (!buttons.length) return;

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const card = button.closest("[data-smoothie-card]");
      if (!card) return;

      const name = card.getAttribute("data-drink-name") || card.querySelector("h3")?.textContent?.trim();
      const priceRaw = card.getAttribute("data-drink-price") || "0";
      const price = Number.parseFloat(priceRaw) || 0;

      if (!name) return;

      const items = getStoredOrder();
      const existing = items.find((item) => item.name === name && !item.notes);
      if (existing) {
        existing.qty += 1;
      } else {
        items.push({ name, price, qty: 1, notes: "" });
      }

      saveOrder(items);
      updateOrderSummary();
      button.textContent = "Added";
      setTimeout(() => (button.textContent = "Add Drinks to My Order"), 1200);
      window.location.href = `${window.location.origin}/booking/#checkout`;
    });
  });
};

const initFaqAccordion = () => {
  const items = Array.from(document.querySelectorAll(".faq-item"));
  if (!items.length) return;

  items.forEach((item) => {
    item.addEventListener("toggle", () => {
      if (!item.open) return;
      items.forEach((other) => {
        if (other !== item) {
          other.removeAttribute("open");
        }
      });
    });
  });
};

const initCountUp = () => {
  const targets = Array.from(document.querySelectorAll("[data-count]"));
  if (!targets.length) return;

  const animate = (el) => {
    const target = Number(el.getAttribute("data-count") || 0);
    const suffix = el.getAttribute("data-suffix") || "";
    const duration = 1400;
    const startTime = performance.now();

    const step = (now) => {
      const progress = Math.min((now - startTime) / duration, 1);
      const value = Math.floor(progress * target);
      el.textContent = `${value}${suffix}`;
      if (progress < 1) {
        requestAnimationFrame(step);
      }
    };

    requestAnimationFrame(step);
  };

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animate(entry.target);
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.6 }
  );

  targets.forEach((el) => observer.observe(el));
};

const initWhatsappWidget = () => {
  const widget = document.querySelector("[data-whatsapp-widget]");
  const closeBtn = document.querySelector("[data-whatsapp-close]");
  const minimizeBtn = document.querySelector("[data-whatsapp-minimize]");
  const expandBtn = document.querySelector("[data-whatsapp-expand]");
  if (!widget || !closeBtn) return;

  closeBtn.addEventListener("click", () => {
    widget.style.display = "none";
  });

  if (minimizeBtn && expandBtn) {
    minimizeBtn.addEventListener("click", () => {
      widget.classList.add("is-minimized");
    });

    expandBtn.addEventListener("click", () => {
      widget.classList.remove("is-minimized");
    });
  }
};

const initBookingModern = () => {
  const root = document.querySelector(".booking-modern");
  if (!root) return;

  const bookingStorageKey = "daCateringBookingModern";
  let currentStep = 1;

  const tabButtons = root.querySelectorAll(".tab-btn");
  tabButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const targetTab = btn.dataset.tab;
      tabButtons.forEach((b) => b.classList.remove("active"));
      root.querySelectorAll(".tab-panel").forEach((panel) => panel.classList.remove("active"));
      btn.classList.add("active");
      const panel = root.querySelector(`[data-panel=\"${targetTab}\"]`);
      if (panel) {
        panel.classList.add("active");
      }
    });
  });

  const goToStep = (stepNumber) => {
    currentStep = stepNumber;
    root.querySelectorAll(".form-step").forEach((step) => step.classList.remove("active"));
    const targetStep = root.querySelector(`[data-step-content=\"${stepNumber}\"]`);
    if (targetStep) {
      targetStep.classList.add("active");
    }

    const stepItems = root.querySelectorAll(".step-item");
    stepItems.forEach((item, index) => {
      const stepNum = index + 1;
      item.classList.remove("active", "completed");
      if (stepNum < stepNumber) {
        item.classList.add("completed");
      } else if (stepNum === stepNumber) {
        item.classList.add("active");
      }
    });

    const form = root.querySelector(".booking-form");
    if (form) {
      form.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    if (stepNumber === 4) {
      updateBookingSummary();
    }
  };

  const showFieldError = (input, message) => {
    input.style.borderColor = "#ef4444";
    const existingError = input.parentElement.querySelector(".field-error");
    if (existingError) {
      existingError.remove();
    }
    const errorDiv = document.createElement("div");
    errorDiv.className = "field-error";
    errorDiv.style.cssText = "color:#ef4444;font-size:0.85rem;margin-top:4px;";
    errorDiv.textContent = message;
    input.parentElement.appendChild(errorDiv);
  };

  const clearFieldError = (input) => {
    input.style.borderColor = "";
    const error = input.parentElement.querySelector(".field-error");
    if (error) {
      error.remove();
    }
  };

  const isValidEmail = (email) => /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/.test(email);
  const isValidPhone = (phone) => {
    const digits = phone.replace(/\\D/g, "");
    return digits.length >= 10;
  };

  const validateCurrentStep = () => {
    const currentStepEl = root.querySelector(".form-step.active");
    if (!currentStepEl) return true;

    let isValid = true;
    const requiredInputs = currentStepEl.querySelectorAll("[required]");
    requiredInputs.forEach((input) => {
      if (!String(input.value || "").trim()) {
        isValid = false;
        showFieldError(input, "This field is required");
      } else {
        clearFieldError(input);
      }
    });

    currentStepEl.querySelectorAll("input[type=\"email\"]").forEach((input) => {
      const emailValue = String(input.value || "").trim();
      if (emailValue && !isValidEmail(emailValue)) {
        isValid = false;
        showFieldError(input, "Please enter a valid email address");
      }
    });

    currentStepEl.querySelectorAll("input[type=\"tel\"]").forEach((input) => {
      const phoneValue = String(input.value || "").trim();
      if (phoneValue && !isValidPhone(phoneValue)) {
        isValid = false;
        showFieldError(input, "Please enter a valid phone number");
      }
    });

    return isValid;
  };

  window.nextStep = (stepNumber) => {
    if (validateCurrentStep()) {
      goToStep(stepNumber);
      saveFormProgress();
    }
  };

  window.prevStep = (stepNumber) => {
    goToStep(stepNumber);
  };

  const serviceRadios = root.querySelectorAll("input[name=\"service_type\"]");
  const deliveryField = root.querySelector(".delivery-address");
  serviceRadios.forEach((radio) => {
    radio.addEventListener("change", () => {
      if (!deliveryField) return;
      if (radio.value === "delivery") {
        deliveryField.style.display = "block";
        const textarea = deliveryField.querySelector("textarea");
        if (textarea) textarea.setAttribute("required", "required");
      } else {
        deliveryField.style.display = "none";
        const textarea = deliveryField.querySelector("textarea");
        if (textarea) textarea.removeAttribute("required");
      }
    });
  });

  const getInputValue = (labelText) => {
    const labels = Array.from(root.querySelectorAll(".form-label"));
    const label = labels.find((l) => l.textContent.includes(labelText));
    if (!label) return "Not specified";
    const input = label.parentElement.querySelector("input, textarea");
    return input && input.value ? input.value : "Not specified";
  };

  const getSelectText = (labelText) => {
    const labels = Array.from(root.querySelectorAll(".form-label"));
    const label = labels.find((l) => l.textContent.includes(labelText));
    if (!label) return "Not specified";
    const select = label.parentElement.querySelector("select");
    return select && select.selectedIndex > 0 ? select.options[select.selectedIndex].text : "Not specified";
  };

  const getRadioValue = (name) => {
    const radio = root.querySelector(`input[name=\"${name}\"]:checked`);
    if (!radio) return "Not specified";
    const label = radio.closest(".radio-card")?.querySelector("strong");
    return label ? label.textContent : radio.value;
  };

  const updateBookingSummary = () => {
    const summaryContainer = root.querySelector(".booking-summary");
    if (!summaryContainer) return;

    const summaryHTML = `
      <div class=\"summary-grid\" style=\"display:grid;gap:20px;\">
        <div class=\"summary-section\">
          <h4 style=\"color:var(--booking-primary);margin-bottom:12px;font-size:1rem;\">Event Details</h4>
          <div style=\"display:grid;gap:8px;\">
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Event Type:</span><strong>${getSelectText("Event Type")}</strong></div>
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Guests:</span><strong>${getSelectText("Number of Guests")}</strong></div>
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Date:</span><strong>${getInputValue("Event Date")}</strong></div>
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Time:</span><strong>${getInputValue("Event Time")}</strong></div>
          </div>
        </div>
        <div class=\"summary-section\">
          <h4 style=\"color:var(--booking-primary);margin-bottom:12px;font-size:1rem;\">Contact Information</h4>
          <div style=\"display:grid;gap:8px;\">
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Name:</span><strong>${getInputValue("Full Name")}</strong></div>
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Email:</span><strong>${getInputValue("Email Address")}</strong></div>
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Phone:</span><strong>${getInputValue("Phone Number")}</strong></div>
          </div>
        </div>
        <div class=\"summary-section\">
          <h4 style=\"color:var(--booking-primary);margin-bottom:12px;font-size:1rem;\">Service Details</h4>
          <div style=\"display:grid;gap:8px;\">
            <div style=\"display:flex;justify-content:space-between;\"><span style=\"color:var(--booking-muted);\">Service Type:</span><strong>${getRadioValue("service_type")}</strong></div>
          </div>
        </div>
      </div>
    `;

    summaryContainer.innerHTML = summaryHTML;
  };

  const saveFormProgress = () => {
    const form = root.querySelector("#cateringForm");
    if (!form) return;

    const formData = new FormData(form);
    const data = {};
    for (const [key, value] of formData.entries()) {
      if (data[key]) {
        data[key] = Array.isArray(data[key]) ? [...data[key], value] : [data[key], value];
      } else {
        data[key] = value;
      }
    }

    try {
      localStorage.setItem(bookingStorageKey, JSON.stringify(data));
    } catch {
      return;
    }
  };

  const loadFormProgress = () => {
    try {
      const saved = localStorage.getItem(bookingStorageKey);
      if (!saved) return;
      const data = JSON.parse(saved);
      const form = root.querySelector("#cateringForm");
      if (!form) return;

      Object.keys(data).forEach((key) => {
        const inputs = form.querySelectorAll(`[name=\"${key}\"]`);
        inputs.forEach((input) => {
          if (input.type === "checkbox") {
            const values = Array.isArray(data[key]) ? data[key] : [data[key]];
            input.checked = values.includes(input.value);
          } else if (input.type === "radio") {
            input.checked = input.value === data[key];
          } else {
            input.value = data[key];
          }
        });
      });

      const selectedService = form.querySelector("input[name=\"service_type\"]:checked");
      if (selectedService && deliveryField) {
        if (selectedService.value === "delivery") {
          deliveryField.style.display = "block";
          const textarea = deliveryField.querySelector("textarea");
          if (textarea) textarea.setAttribute("required", "required");
        }
      }
    } catch {
      return;
    }
  };

  window.sendWhatsApp = () => {
    if (!validateCurrentStep()) return;
    let message = "New Catering Booking Request%0A%0A";
    message += `Event Type: ${encodeURIComponent(getSelectText("Event Type"))}%0A`;
    message += `Guests: ${encodeURIComponent(getSelectText("Number of Guests"))}%0A`;
    message += `Date: ${encodeURIComponent(getInputValue("Event Date"))}%0A`;
    message += `Time: ${encodeURIComponent(getInputValue("Event Time"))}%0A%0A`;
    message += `Name: ${encodeURIComponent(getInputValue("Full Name"))}%0A`;
    message += `Email: ${encodeURIComponent(getInputValue("Email Address"))}%0A`;
    message += `Phone: ${encodeURIComponent(getInputValue("Phone Number"))}%0A`;
    message += `Service Type: ${encodeURIComponent(getRadioValue("service_type"))}`;

    const phoneNumber = "14034782475";
    window.open(`https://wa.me/${phoneNumber}?text=${message}`, "_blank");
  };

  const form = root.querySelector("#cateringForm");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      if (!validateCurrentStep()) return;
      localStorage.removeItem(bookingStorageKey);
      const wrapper = root.querySelector(".booking-form-wrapper");
      if (wrapper) {
        wrapper.innerHTML = `
          <div style=\"text-align:center;padding:60px 40px;\">
            <div style=\"width:80px;height:80px;border-radius:50%;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;\">
              <svg width=\"40\" height=\"40\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"#10b981\" stroke-width=\"2\">\n                <polyline points=\"20 6 9 17 4 12\"/>\n              </svg>
            </div>
            <h2 style=\"color:var(--booking-primary);font-size:2rem;margin-bottom:16px;\">Booking Request Submitted!</h2>
            <p style=\"color:var(--booking-muted);font-size:1.1rem;max-width:500px;margin:0 auto 32px;\">Thank you for your booking request. We'll review your details and get back to you within 2 hours with a customized quote.</p>
            <a href=\"/\" class=\"btn btn-primary\" style=\"margin-top:20px;\">Return to Homepage</a>
          </div>
        `;
      }
    });

    form.addEventListener("change", saveFormProgress);
  }

  const checkoutForm = root.querySelector("#checkoutForm");
  if (checkoutForm) {
    checkoutForm.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Order placed successfully! Check your email for confirmation.");
    });
  }

  loadFormProgress();
  goToStep(currentStep);
};

document.addEventListener("DOMContentLoaded", () => {
  initMenuActions();
  initFilters();
  initMobileMenu();
  initCarousel();
  initDragScroll();
  initMenuCardFocus();
  initOrderSummary();
  initDeliveryToggle();
  initBookingTabs();
  initBookingForms();
  initBookingSmoothScroll();
  initBookingOrderControls();
  initSmoothiesDeck();
  initSmoothiesButtons();
  initFaqAccordion();
  initCountUp();
  initWhatsappWidget();
  initBookingModern();

  const clearBtn = document.querySelector("[data-clear-order]");
  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      localStorage.removeItem(orderKey);
      updateOrderSummary();
    });
  }
});
