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

  const cards = Array.from(menuTrack.querySelectorAll(".product-card"));
  if (!cards.length) return;

  let ticking = false;
  const dotsContainer = document.querySelector("[data-menu-dots]");

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
        buildDots();
        updateActiveCard();
      }, 0);
    });
  });

  buildDots();
  updateActiveCard();
};

const initBookingTabs = () => {
  const page = document.querySelector(".booking-page");
  if (!page) return;

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
  if (!page) return;

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
  if (!page) return;

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
  if (!page) return;

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

  const clearBtn = document.querySelector("[data-clear-order]");
  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      localStorage.removeItem(orderKey);
      updateOrderSummary();
    });
  }
});
