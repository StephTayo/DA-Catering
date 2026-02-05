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

const updateOrderSummary = () => {
  const container = document.querySelector("[data-order-summary]");
  if (!container) return;

  const items = getStoredOrder();
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

document.addEventListener("DOMContentLoaded", () => {
  initMenuActions();
  initFilters();
  initMobileMenu();
  initCarousel();
  initDragScroll();
  initOrderSummary();
  initDeliveryToggle();

  const clearBtn = document.querySelector("[data-clear-order]");
  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      localStorage.removeItem(orderKey);
      updateOrderSummary();
    });
  }
});

