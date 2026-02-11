
<section id="home" class="hero-iso">
  <div class="hero-iso__video" aria-hidden="true">
    <video autoplay muted loop playsinline preload="metadata" poster="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1400&q=80">
      <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/hero.mp4'); ?>" type="video/mp4">
    </video>
  </div>
  <div class="hero-iso__scrim" aria-hidden="true"></div>
  <div class="container hero-iso__container">
    <div class="hero-iso__content">
      <span class="hero-iso__badge">
        <span class="hero-iso__badge-dot" aria-hidden="true"></span>
        Now Serving Calgary &amp; Area
      </span>
      <h1 class="hero-iso__title">
        Authentic African
        <span>Flavors Delivered</span>
      </h1>
      <p class="hero-iso__description">
        Experience the rich taste of Africa with our bespoke catering services. From intimate gatherings to grand celebrations, we bring authentic cuisine to your table.
      </p>
      <div class="hero-iso__actions">
        <a class="hero-iso__btn hero-iso__btn--primary" href="<?php echo esc_url(home_url('/booking/#booking')); ?>">
          Book Catering Now
          <span aria-hidden="true">→</span>
        </a>
        <a class="hero-iso__btn hero-iso__btn--secondary" href="<?php echo esc_url(home_url('/#menu')); ?>">
          View Menu
        </a>
      </div>
      <div class="hero-iso__trust">
        <span>Trusted by 500+ Calgary events</span>
        <span aria-hidden="true">•</span>
        <span>4.9/5 average rating</span>
      </div>
      <div class="hero-iso__stats">
        <div class="hero-iso__stat">
          <div class="hero-iso__stat-number" data-count="100" data-suffix="+">100+</div>
          <div class="hero-iso__stat-label">Dishes</div>
        </div>
        <div class="hero-iso__stat">
          <div class="hero-iso__stat-number" data-count="500" data-suffix="+">500+</div>
          <div class="hero-iso__stat-label">Happy Clients</div>
        </div>
        <div class="hero-iso__stat">
          <div class="hero-iso__stat-number" data-count="5" data-suffix="★">5<span class="hero-iso__star" aria-hidden="true">★</span></div>
          <div class="hero-iso__stat-label">Rating</div>
        </div>
      </div>
    </div>

    <div class="hero-iso__media">
      <div class="hero-iso__image-grid">
        <div class="hero-iso__image-card">
          <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=900&q=80" alt="African dish with colorful garnish" loading="eager" fetchpriority="high">
        </div>
        <div class="hero-iso__image-card hero-iso__image-card--offset-top">
          <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=900&q=80" alt="Refreshing beverages and juices" loading="lazy">
        </div>
        <div class="hero-iso__image-card hero-iso__image-card--offset-bottom">
          <img src="https://images.unsplash.com/photo-1481833761820-0509d3217039?auto=format&fit=crop&w=1200&q=80" alt="Catering event buffet setup" loading="lazy">
        </div>
        <div class="hero-iso__image-card hero-iso__image-card--tall">
          <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=900&q=80" alt="Colorful African food platter" loading="lazy">
        </div>
      </div>

      <div class="hero-iso__rating-card">
        <div class="hero-iso__rating-icon" aria-hidden="true">⭐</div>
        <div class="hero-iso__rating-text">
          <div class="hero-iso__rating-score">4.9/5</div>
          <div class="hero-iso__rating-label">500+ Reviews</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section ordering-steps">
  <div class="container">
    <h2 class="section-title">How Ordering Works</h2>
    <p class="section-subtitle">Fast, simple, and built for mobile. Order African food in Calgary in three easy steps.</p>
    <div class="steps">
      <div class="step-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1729875750386-a27f8d4e58ce?fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Ordering step preview">
        <div class="step-number">1</div>
        <h3>Pick items + quantities</h3>
        <p>Browse the menu, choose your favorite dishes, and set portions that fit your appetite.</p>
      </div>
      <div class="step-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1767096088534-a000c3501c3a?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Delivery step preview">
        <div class="step-number">2</div>
        <h3>Choose pickup or delivery</h3>
        <p>Select pickup or delivery and tell us your preferred time window in Calgary.</p>
      </div>
      <div class="step-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1738669469338-801b4e9dbccf?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Confirmation step preview">
        <div class="step-number">3</div>
        <h3>Submit + confirm</h3>
        <p>Send your order and receive confirmation by WhatsApp, email, and SMS.</p>
      </div>
    </div>
  </div>
</section>

<section id="menu" class="section accent">
  <div class="container">
    <h2 class="section-title">Menu / Shop</h2>
    <p class="section-subtitle">What we have on our menu today.</p>
    <div class="hero-actions" style="margin-bottom: 18px;">
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/shop')); ?>">Go to Shop &amp; Checkout</a>
      <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/cart')); ?>">View Cart</a>
    </div>
    <div class="menu-filters">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="rice">Rice Dishes</button>
      <button class="filter-btn" data-filter="swallow">Swallows &amp; Soups</button>
      <button class="filter-btn" data-filter="stew">Stews &amp; Sauces</button>
      <button class="filter-btn" data-filter="chops">Small Chops</button>
      <button class="filter-btn" data-filter="protein">Proteins</button>
      <button class="filter-btn" data-filter="veg">Vegetarian</button>
      <button class="filter-btn" data-filter="smoothie">Smoothies</button>
      <button class="filter-btn" data-filter="juice">Fresh Juices</button>
      <button class="filter-btn" data-filter="tray">Party Trays</button>
    </div>

    <div class="menu-carousel" data-carousel>
      <button class="carousel-btn prev" type="button" aria-label="Scroll menu left" data-carousel-prev>&lsaquo;</button>
      <div class="product-grid" data-carousel-track data-drag-track>
      <article class="product-card" data-product data-name="Jollof Rice" data-price="18" data-category="rice">
        <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=1200&q=80" alt="Authentic Nigerian Jollof rice with fried plantain and chicken - DA Catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Jollof Rice</h3>
          <p>Party-style West African rice simmered in tomato pepper sauce, served with grilled chicken.</p>
          <div class="spice-level">Heat: Medium</div>
          <div class="size-options">Sizes: Individual, Small, Medium, Large, Family</div>
          <div class="price">$18.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: extra pepper, no onions" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Fried Rice" data-price="17" data-category="rice">
        <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=1200&q=80" alt="West African fried rice with mixed vegetables and protein - DA Catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Fried Rice</h3>
          <p>West African fried rice with mixed vegetables, beef strips, and fragrant spices.</p>
          <div class="spice-level">Heat: Mild</div>
          <div class="size-options">Sizes: Individual, Small, Medium, Large, Family</div>
          <div class="price">$17.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: add shrimp" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Egusi Soup & Pounded Yam" data-price="22" data-category="swallow">
        <img src="https://images.unsplash.com/photo-1604909052868-94d5f80e9bfb?auto=format&fit=crop&w=1200&q=80" alt="West African Egusi soup with pounded yam - African food delivery YYC" loading="lazy">
        <div class="product-body">
          <h3>Egusi Soup &amp; Pounded Yam</h3>
          <p>Melon seed soup with spinach and assorted proteins, paired with smooth pounded yam.</p>
          <div class="spice-level">Heat: Medium</div>
          <div class="size-options">Sizes: Individual, Small, Medium, Large</div>
          <div class="price">$22.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: extra beef" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Semovita & Efo Riro" data-price="21" data-category="swallow">
        <img src="https://images.unsplash.com/photo-1608039829574-0afbe07f2005?auto=format&fit=crop&w=1200&q=80" alt="Semovita and Efo Riro vegetable soup - Nigerian catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Semovita &amp; Efo Riro</h3>
          <p>Leafy vegetable soup with peppers and palm oil, served with semovita swallow.</p>
          <div class="spice-level">Heat: Hot</div>
          <div class="size-options">Sizes: Individual, Small, Medium, Large</div>
          <div class="price">$21.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: less oil" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Red Stew" data-price="19" data-category="stew">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Red stew with peppers and protein - African catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Red Stew</h3>
          <p>Tomato-based stew with peppers and tender beef, perfect with rice or yam.</p>
          <div class="spice-level">Heat: Medium</div>
          <div class="size-options">Sizes: Small, Medium, Large, Family</div>
          <div class="price">$19.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: add chicken" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Ayamase (Ofada Stew)" data-price="22" data-category="stew">
        <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=1200&q=80" alt="Ofada rice with ayamase green pepper stew - Nigerian catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Ayamase / Ofada Stew</h3>
          <p>Designer green pepper stew with assorted meats, served with Ofada rice.</p>
          <div class="spice-level">Heat: Extra Hot</div>
          <div class="size-options">Sizes: Individual, Small, Medium, Large</div>
          <div class="price">$22.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: extra sauce" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Suya Skewers" data-price="16" data-category="protein chops">
        <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=1200&q=80" alt="Suya skewers - grilled spicy beef - Nigerian catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Suya Skewers</h3>
          <p>Spicy grilled beef skewers coated in groundnut spice. A Calgary favorite.</p>
          <div class="spice-level">Heat: Hot</div>
          <div class="size-options">Sizes: 6 pcs, 12 pcs, Party tray</div>
          <div class="price">$16.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: extra spice" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Dodo (Fried Plantain)" data-price="12" data-category="chops veg">
        <img src="https://images.unsplash.com/photo-1608039829574-0afbe07f2005?auto=format&fit=crop&w=1200&q=80" alt="Dodo fried plantain - West African food YYC" loading="lazy">
        <div class="product-body">
          <h3>Dodo (Fried Plantain)</h3>
          <p>Sweet or savory plantain slices fried to golden perfection.</p>
          <div class="spice-level">Heat: Mild</div>
          <div class="size-options">Sizes: Individual, Family</div>
          <div class="price">$12.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: add pepper sauce" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Puff Puff" data-price="10" data-category="chops">
        <img src="https://images.unsplash.com/photo-1532635241-17e820acc59f?auto=format&fit=crop&w=1200&q=80" alt="Puff puff sweet fried dough balls - African catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Puff Puff</h3>
          <p>Soft and fluffy African dough balls with a gentle sweetness.</p>
          <div class="spice-level">Heat: Mild</div>
          <div class="size-options">Sizes: 12 pcs, 24 pcs, Party tray</div>
          <div class="price">$10.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: dusted sugar" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Moi Moi" data-price="14" data-category="veg">
        <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=1200&q=80" alt="Moi Moi steamed bean pudding - African food delivery YYC" loading="lazy">
        <div class="product-body">
          <h3>Moi Moi</h3>
          <p>Steamed bean pudding with peppers and onions. Great for vegetarian guests.</p>
          <div class="spice-level">Heat: Mild</div>
          <div class="size-options">Sizes: Individual, Small, Medium</div>
          <div class="price">$14.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: add fish" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Asun (Spicy Goat)" data-price="23" data-category="protein">
        <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=1200&q=80" alt="Asun spicy grilled goat meat - African catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Asun (Spicy Goat)</h3>
          <p>Smoky grilled goat tossed in pepper sauce. A must-try street-style favorite.</p>
          <div class="spice-level">Heat: Extra Hot</div>
          <div class="size-options">Sizes: Individual, Small, Large, Party tray</div>
          <div class="price">$23.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: less spice" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Okra Soup" data-price="19" data-category="swallow veg">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Okra soup with vegetables - African food delivery YYC" loading="lazy">
        <div class="product-body">
          <h3>Okra Soup</h3>
          <p>Delicate okra draw soup with leafy greens and assorted proteins.</p>
          <div class="spice-level">Heat: Medium</div>
          <div class="size-options">Sizes: Individual, Small, Medium</div>
          <div class="price">$19.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: extra fish" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Tropical Mango Smoothie" data-price="8" data-category="smoothie">
        <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80" alt="Fresh mango smoothie with tropical fruits - DA Catering YYC" loading="lazy">
        <div class="product-body">
          <h3>Tropical Mango Smoothie</h3>
          <p>Mango, banana, and coconut blended into a creamy refreshment.</p>
          <div class="spice-level">Heat: None</div>
          <div class="size-options">Sizes: Small, Medium, Large</div>
          <div class="price">$8.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: no coconut" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Orange Carrot Boost" data-price="7" data-category="juice">
        <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80" alt="Fresh orange carrot juice - African catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Orange Carrot Boost</h3>
          <p>Orange, carrot, and turmeric for a bright, energizing juice.</p>
          <div class="spice-level">Heat: None</div>
          <div class="size-options">Sizes: Small, Medium, Large</div>
          <div class="price">$7.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: no ginger" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>

      <article class="product-card" data-product data-name="Party Tray: Jollof + Suya + Dodo" data-price="150" data-category="tray">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Party tray with jollof rice, suya, and dodo - African catering Calgary" loading="lazy">
        <div class="product-body">
          <h3>Party Tray: Jollof + Suya + Dodo</h3>
          <p>Large-format tray for 8-12 guests with rice, grilled beef, and plantain.</p>
          <div class="spice-level">Heat: Medium</div>
          <div class="size-options">Sizes: Small, Medium, Large, Family</div>
          <div class="price">$150.00</div>
          <div class="qty-selector">
            <button type="button" data-qty-minus>-</button>
            <span data-qty-display>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          <input class="note-input" type="text" placeholder="Notes: add puff puff tray" data-notes>
          <div class="card-actions">
            <button class="btn btn-primary" type="button" data-add-item>Add to Order</button>
          </div>
        </div>
      </article>
      </div>
      <button class="carousel-btn next" type="button" aria-label="Scroll menu right" data-carousel-next>&rsaquo;</button>
    </div>
    <div class="menu-pagination" data-menu-dots></div>
  </div>
</section>

<section id="catering" class="section catering-section">
  <div class="container">
    <div class="catering-header">
      <span class="catering-pill">Perfect for Any Event</span>
      <h2 class="section-title">Catering Packages</h2>
      <p class="section-subtitle">Tailored menus for small get-togethers, family celebrations, and full-scale events.</p>
    </div>
    <div class="catering-grid">
      <div class="catering-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1769812344084-b45b638b1737?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Small gathering catering preview">
        <span class="catering-icon" aria-hidden="true">🥘</span>
        <h3>Small Gathering</h3>
        <p>Perfect for 5-10 people. Two rice dishes, one stew, grilled protein, and sides with sauces.</p>
        <span class="catering-label">Starting at</span>
        <strong>$150</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking/#booking')); ?>">Book Now</a>
      </div>
      <div class="catering-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1729875750386-a27f8d4e58ce?fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Family tray catering preview">
        <span class="catering-icon" aria-hidden="true">🍽️</span>
        <h3>Family Tray</h3>
        <p>Ideal for 10-20 people. Expanded menu with jollof, fried rice, soups, and assorted small chops.</p>
        <span class="catering-label">Starting at</span>
        <strong>$300</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking/#booking')); ?>">Book Now</a>
      </div>
      <div class="catering-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1767096088534-a000c3501c3a?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Event catering preview">
        <span class="catering-icon" aria-hidden="true">🎉</span>
        <h3>Event Catering</h3>
        <p>For 20-100+ people. Full-service options, custom menu, and staffing support for large events.</p>
        <span class="catering-label">Starting at</span>
        <strong>$500+</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking/#booking')); ?>">Book Now</a>
      </div>
    </div>
  </div>
</section>
<section id="featured" class="section featured-section">
  <div class="container">
    <h2 class="section-title">Featured African Delicacies</h2>
    <p class="section-subtitle">Popular picks across West, East, Central, and Southern African cuisine. Ask for cultural context when needed.</p>
    <div class="featured-carousel" data-carousel>
      <button class="carousel-btn prev" type="button" aria-label="Scroll featured left" data-carousel-prev>&lsaquo;</button>
      <div class="featured-grid" data-carousel-track data-drag-track>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1767096088534-a000c3501c3a?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Rice dishes preview">
        <h3>Rice Dishes</h3>
        <ul>
          <li>Fried Rice (West African style)</li>
          <li>Jollof Rice</li>
          <li>Jambalaya Rice</li>
          <li>White Rice &amp; Ofada Sauce<span class="info-icon" title="Traditional green sauce">i</span></li>
          <li>Ofada Rice &amp; Ayamase</li>
          <li>Pilau (East African spiced rice)</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1729875750386-a27f8d4e58ce?fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Stews and sauces preview">
        <h3>Stews &amp; Sauces</h3>
        <ul>
          <li>Red Stew</li>
          <li>Gizdodo (gizzard and dodo)</li>
          <li>Ayamase / Ofada Stew</li>
          <li>Banga Soup (Ofe Akwu)</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1769812344084-b45b638b1737?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Soups and swallows preview">
        <h3>Soups &amp; Swallows</h3>
        <ul>
          <li>Egusi Soup &amp; Pounded Yam</li>
          <li>Semovita &amp; Efo Riro</li>
          <li>Amala &amp; Abula (Gbegiri + Ewedu)</li>
          <li>Fisherman Soup</li>
          <li>Edikang Ikong Soup</li>
          <li>White Soup (Ofe Nsala / Ofe Insala)</li>
          <li>Ofe Onugbu (Bitterleaf Soup)</li>
          <li>Ogbono Soup</li>
          <li>Okra Soup</li>
          <li>Afang Soup</li>
          <li>Ugali (East African staple)</li>
          <li>Pap (Southern African maize porridge)</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1767096088534-a000c3501c3a?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Sides and street food preview">
        <h3>Sides &amp; Street Food</h3>
        <ul>
          <li>Dodo (Fried Plantain)</li>
          <li>Puff Puff</li>
          <li>Chin Chin</li>
          <li>Meat Pie</li>
          <li>Buns</li>
          <li>Shawarma (West African street-style)</li>
          <li>Chapati</li>
          <li>Mandazi</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1738669469338-801b4e9dbccf?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Proteins and grilled preview">
        <h3>Proteins &amp; Grilled</h3>
        <ul>
          <li>Suya</li>
          <li>Kilishi</li>
          <li>Asun</li>
          <li>Peppered Goat Meat</li>
          <li>Nkwobi</li>
          <li>Isi Ewu</li>
          <li>Shisa Nyama-style grilled meats</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1769812344084-b45b638b1737?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Beans and pasta preview">
        <h3>Beans, Porridges &amp; Pasta</h3>
        <ul>
          <li>Moi Moi</li>
          <li>Akara</li>
          <li>Yam Porridge (Asaro)</li>
          <li>Beans &amp; Plantain</li>
          <li>Ewa Agoyin</li>
          <li>Gbegiri (Bean soup)</li>
          <li>Jollof Spaghetti</li>
          <li>Nigerian-style Spaghetti</li>
        </ul>
      </div>
      <div class="featured-card">
        <img class="card-placeholder" src="https://images.unsplash.com/photo-1729875750386-a27f8d4e58ce?fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Pepper soups preview">
        <h3>Pepper Soups</h3>
        <ul>
          <li>Pepper Soup - Goat</li>
          <li>Pepper Soup - Fish</li>
          <li>Pepper Soup - Chicken</li>
        </ul>
      </div>
    </div>
      <button class="carousel-btn next" type="button" aria-label="Scroll featured right" data-carousel-next>&rsaquo;</button>
    </div>
  </div>
</section>

<section class="smoothies-to-video">
  <div class="smoothies-bg" aria-hidden="true"></div>
  <div class="sticky-media-stack">
  <div class="smoothies-sticky">
    <div class="smoothies-content">
      <div class="smoothies-intro">
        <h2>Smoothies &amp; Fresh Juices</h2>
        <p class="smoothies-subtitle">Freshly blended smoothies and traditional African beverages to complete your order.</p>
        <p>Choose bright, refreshing blends made to order. Every drink is crafted with ripe fruit, authentic spices, and the option to customize sweetness and spice.</p>
        <p><strong>You</strong> pick the flavor; we handle the freshness.</p>
      </div>

      <div class="smoothies-deck" data-smoothies-deck>
        <article class="drink-card is-active" data-smoothie-card data-drink-name="Tropical Mango Smoothie" data-drink-price="8">
          <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80" alt="Tropical mango smoothie - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Tropical Mango Smoothie</h3>
            <p>Mango, banana, and coconut.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$6-$9</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Pineapple Ginger Zing" data-drink-price="8">
          <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?auto=format&fit=crop&w=1200&q=80" alt="Pineapple ginger smoothie - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Pineapple Ginger Zing</h3>
            <p>Pineapple, ginger, lime.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$6-$9</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Watermelon Cooler" data-drink-price="7">
          <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?auto=format&fit=crop&w=1200&q=80" alt="Watermelon cooler drink - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Watermelon Cooler</h3>
            <p>Watermelon, mint, lime.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$6-$9</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Orange Carrot Boost" data-drink-price="7">
          <img src="https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&w=1200&q=80" alt="Orange carrot boost juice - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Orange Carrot Boost</h3>
            <p>Orange, carrot, turmeric.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$6-$9</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Berry Blast" data-drink-price="8">
          <img src="https://images.unsplash.com/photo-1506084868230-bb9d95c24759?auto=format&fit=crop&w=1200&q=80" alt="Berry blast smoothie - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Berry Blast</h3>
            <p>Mixed berries, yogurt, honey.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$6-$9</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Zobo / Hibiscus Drink" data-drink-price="6">
          <img src="https://images.unsplash.com/photo-1502741224143-90386d7f8c82?auto=format&fit=crop&w=1200&q=80" alt="Zobo hibiscus drink - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Zobo / Hibiscus Drink</h3>
            <p>Traditional Nigerian hibiscus infusion.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$5-$8</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Kunu / Tigernut Drink" data-drink-price="6">
          <img src="https://images.unsplash.com/photo-1507914372368-b2b085b925a1?auto=format&fit=crop&w=1200&q=80" alt="Kunu tigernut drink - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Kunu / Tigernut Drink</h3>
            <p>Creamy tigernut beverage with spice.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$5-$8</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Chapman" data-drink-price="6">
          <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Chapman non-alcoholic cocktail - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Chapman</h3>
            <p>Nigerian non-alcoholic cocktail with citrus.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$5-$8</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
        <article class="drink-card" data-smoothie-card data-drink-name="Sobolo" data-drink-price="6">
          <img src="https://images.unsplash.com/photo-1502741224143-90386d7f8c82?auto=format&fit=crop&w=1200&q=80" alt="Sobolo Ghanaian hibiscus drink - DA Catering YYC" loading="lazy">
          <div class="drink-details">
            <h3>Sobolo</h3>
            <p>Ghanaian hibiscus drink with pineapple notes.</p>
            <p>Sizes: Small, Medium, Large</p>
            <strong>$5-$8</strong>
            <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
          </div>
        </article>
      </div>
      <div class="smoothies-dots" data-smoothies-dots></div>
    </div>
  </div>
  <div class="event-types">
    <div class="container">
      <div class="event-types-head">
        <h2 class="section-title">Events We Cater</h2>
        <p class="section-subtitle">Corporate, family, and community gatherings across Calgary and surrounding areas.</p>
      </div>
      <div class="event-types-grid">
        <div class="event-type-card">
          <img class="card-placeholder" src="https://images.unsplash.com/photo-1767096088534-a000c3501c3a?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Corporate lunches preview">
          <span class="event-type-icon" aria-hidden="true">💼</span>
          <h3>Corporate Lunches</h3>
          <p>Executive lunches, office celebrations, and client meetings.</p>
        </div>
        <div class="event-type-card">
          <img class="card-placeholder" src="https://images.unsplash.com/photo-1738669469338-801b4e9dbccf?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Birthdays and milestones preview">
          <span class="event-type-icon" aria-hidden="true">🎉</span>
          <h3>Birthdays &amp; Milestones</h3>
          <p>Family-friendly spreads with crowd-pleasing favorites.</p>
        </div>
        <div class="event-type-card">
          <img class="card-placeholder" src="https://images.unsplash.com/photo-1769812344084-b45b638b1737?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Wedding catering preview">
          <span class="event-type-icon" aria-hidden="true">💍</span>
          <h3>Weddings</h3>
          <p>Elegant service, custom menus, and cultural favorites.</p>
        </div>
        <div class="event-type-card">
          <img class="card-placeholder" src="https://images.unsplash.com/photo-1729875750386-a27f8d4e58ce?fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&ixlib=rb-4.1.0&q=60&w=3000" alt="Community gatherings preview">
          <span class="event-type-icon" aria-hidden="true">🤝</span>
          <h3>Community Gatherings</h3>
          <p>Faith events, cultural festivals, and community dinners.</p>
        </div>
      </div>
    </div>
  </div>
  </div>

  <section id="video" class="section video-section">
  <div class="container">
    <h2 class="section-title">Food in Motion</h2>
    <p class="section-subtitle">A quick look at our fresh servings and vibrant plates.</p>
    <div class="video-frame">
      <video controls playsinline preload="metadata" poster="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1400&q=80">
        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/hero.mp4'); ?>" type="video/mp4">
      </video>
    </div>
  </div>
  </section>
</section>

<section id="instagram" class="section instagram-section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Feeds from our Social Media Pages</h2>
      <p class="section-subtitle">A glimpse of our culinary artistry.</p>
    </div>
    <div class="gallery-grid">
      <div class="gallery-card gallery-card--large">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1400&q=80" alt="Plated chef special for DA Catering YYC" loading="lazy">
      </div>
      <div class="gallery-card">
        <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=900&q=80" alt="Catering tray with fruits and bites" loading="lazy">
      </div>
      <div class="gallery-card">
        <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=900&q=80" alt="Dessert table setup for events" loading="lazy">
      </div>
      <div class="gallery-card">
        <img src="https://images.unsplash.com/photo-1481833761820-0509d3217039?auto=format&fit=crop&w=900&q=80" alt="Buffet spread for catering" loading="lazy">
      </div>
      <div class="gallery-card">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80" alt="Chef preparing fresh dishes" loading="lazy">
      </div>
    </div>
  </div>
</section>

<section id="reviews" class="section">
  <div class="container">
    <h2 class="section-title">Reviews</h2>
    <p class="section-subtitle">Honest feedback from Calgary families, corporate teams, and event planners.</p>
    <div class="testimonial-grid" data-drag-track>
      <div class="testimonial-card">
        <div class="testimonial-head">
          <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=140&q=80" alt="Smiling customer" loading="lazy">
          <div>
            <strong>Nadia M.</strong>
            <span>Corporate lunch • Downtown</span>
          </div>
        </div>
        <div class="testimonial-rating">★★★★★</div>
        <p>The jollof rice and suya were a hit at our office lunch. Delivery arrived right on time and was still hot.</p>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-head">
          <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=140&q=80" alt="Happy customer" loading="lazy">
          <div>
            <strong>Kola A.</strong>
            <span>Family dinner • Beltline</span>
          </div>
        </div>
        <div class="testimonial-rating">★★★★★</div>
        <p>We ordered egusi with pounded yam for a family dinner. The flavors tasted like home and portions were generous.</p>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-head">
          <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=140&q=80" alt="Event planner" loading="lazy">
          <div>
            <strong>Stephanie R.</strong>
            <span>Graduation • Sage Hill</span>
          </div>
        </div>
        <div class="testimonial-rating">★★★★☆</div>
        <p>Booking for our graduation celebration was simple. They were responsive on WhatsApp and handled dietary notes well.</p>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-head">
          <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=140&q=80" alt="Customer testimonial" loading="lazy">
          <div>
            <strong>Fatima L.</strong>
            <span>Family celebration • Tuscany</span>
          </div>
        </div>
        <div class="testimonial-rating">★★★★★</div>
        <p>Fresh smoothies and zobo were refreshing. Loved the variety of menu options for vegetarians.</p>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-head">
          <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=140&q=80" alt="Customer review" loading="lazy">
          <div>
            <strong>Chris P.</strong>
            <span>Birthday • University District</span>
          </div>
        </div>
        <div class="testimonial-rating">★★★★☆</div>
        <p>Great value for the family tray and clear pickup instructions. We will order again for birthdays.</p>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="section contact-section">
  <div class="container contact-grid">
    <div class="contact-info">
      <h2 class="section-title">Get in Touch</h2>
      <p class="section-subtitle">Ready to plan your next event? Contact us today for a personalized quote.</p>
      <div class="contact-list">
        <div class="contact-item">
          <span class="contact-icon" aria-hidden="true">📞</span>
          <div>
            <strong>Phone</strong>
            <p>(403) 478-2475</p>
          </div>
        </div>
        <div class="contact-item">
          <span class="contact-icon" aria-hidden="true">✉️</span>
          <div>
            <strong>Email</strong>
            <p>order@dacatering.ca</p>
          </div>
        </div>
        <div class="contact-item">
          <span class="contact-icon" aria-hidden="true">📍</span>
          <div>
            <strong>Location</strong>
            <p>Calgary, Alberta</p>
          </div>
        </div>
        <div class="contact-item">
          <span class="contact-icon" aria-hidden="true">🕒</span>
          <div>
            <strong>Hours</strong>
            <p>Mon - Fri: 9AM - 6PM<br>Sat - Sun: By Appointment</p>
          </div>
        </div>
      </div>
      <div class="contact-social">
        <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook">f</a>
        <a href="https://instagram.com/dacateringyyc" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
        <a href="https://x.com" target="_blank" rel="noopener" aria-label="X">x</a>
      </div>
    </div>
    <form class="contact-card" action="mailto:order@dacatering.ca" method="post" enctype="text/plain">
      <label>
        Full Name
        <input type="text" name="full_name" placeholder="John Doe" required>
      </label>
      <label>
        Email Address
        <input type="email" name="email" placeholder="john@example.com" required>
      </label>
      <label>
        Phone Number
        <input type="tel" name="phone" placeholder="(403) 478-2475">
      </label>
      <label>
        Event Type
        <select name="event_type" required>
          <option value="" selected>Select event type</option>
          <option>Wedding</option>
          <option>Corporate Event</option>
          <option>Private Party</option>
          <option>Other</option>
        </select>
      </label>
      <label>
        Message
        <textarea name="message" rows="5" placeholder="Tell us about your event..."></textarea>
      </label>
      <button class="btn btn-primary" type="submit">Send Message</button>
    </form>
  </div>
</section>

<section id="faq" class="section faq-section">
  <div class="container faq-layout">
    <div class="faq-list">
      <h2 class="section-title">Frequently asked questions</h2>
      <p class="section-subtitle">Everything you need to know about ordering, delivery, and catering in Calgary.</p>
      <div class="faq-items">
        <details class="faq-item">
          <summary>What areas in Calgary do you deliver to?</summary>
          <p>We deliver across Calgary and nearby communities. Share your postal code on WhatsApp to confirm availability.</p>
        </details>
        <details class="faq-item">
          <summary>How does the service work?</summary>
          <p>Choose dishes, submit your order or catering request, and we confirm everything by WhatsApp, email, or SMS.</p>
        </details>
        <details class="faq-item">
          <summary>Do you offer same-day delivery or catering?</summary>
          <p>Same-day pickup is sometimes available for select dishes. Catering requests need 48-72 hours notice.</p>
        </details>
        <details class="faq-item">
          <summary>Can you accommodate food allergies and dietary restrictions?</summary>
          <p>Yes. Please add detailed allergy notes in the order or booking form so we can confirm safe options.</p>
        </details>
        <details class="faq-item">
          <summary>Do you have vegetarian or vegan options?</summary>
          <p>Absolutely. We offer plant-based soups, rice dishes, and sides. Ask us for a tailored vegetarian menu.</p>
        </details>
      </div>
    </div>
    <div class="faq-aside">
      <h3>Got more questions?</h3>
      <p>Send us a quick note and we will respond fast.</p>
      <a class="btn btn-secondary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I%20have%20a%20question%20about%20ordering.">Visit our FAQ</a>
    </div>
  </div>
</section>

<div class="whatsapp-concierge" data-whatsapp-widget>
  <button class="whatsapp-concierge__minimize" type="button" aria-label="Minimize WhatsApp concierge" data-whatsapp-minimize>–</button>
  <button class="whatsapp-concierge__close" type="button" aria-label="Close WhatsApp concierge" data-whatsapp-close>×</button>
  <button class="whatsapp-concierge__expand" type="button" aria-label="Expand WhatsApp concierge" data-whatsapp-expand>
    Need help fast?
  </button>
  <div class="whatsapp-concierge__content">
    <span class="whatsapp-concierge__badge">Need help fast?</span>
    <h4>Chat with our catering concierge</h4>
    <p>Tell us your guest count and event date. We reply in minutes.</p>
    <a class="btn btn-primary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I%20need%20help%20with%20my%20order.%20My%20event%20date%20is%20____%20and%20guest%20count%20is%20____." target="_blank" rel="noopener">Message on WhatsApp</a>
  </div>
</div>
