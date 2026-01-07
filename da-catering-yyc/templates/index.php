
<section id="home" class="hero">
  <div class="hero-video" aria-hidden="true">
    <video autoplay muted loop playsinline preload="metadata" poster="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80">
      <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/hero.mp4'); ?>" type="video/mp4">
    </video>
  </div>
  <div class="hero-scrim" aria-hidden="true"></div>
  <div class="container hero-grid">
    <div class="hero-media" aria-hidden="true">
      <div class="hero-shot tall">
        <img src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=900&q=80" alt="">
      </div>
      <div class="hero-shot wide">
        <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=1100&q=80" alt="">
      </div>
      <div class="hero-shot tall">
        <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=900&q=80" alt="">
      </div>
    </div>
    <div class="hero-copy">
      <h1>Authentic African flavors, delivered fresh</h1>
      <p class="hero-subtitle">Bespoke meals for every occasion - from comfort food to full-service catering. Enjoy 100+ dishes, smoothies, and juices, all made fresh and delivered with care.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I'd%20like%20to%20place%20an%20order.%20My%20name%20is%20____%20and%20my%20order%20details%20are:%20____" target="_blank" rel="noopener">Order now</a>
        <a class="btn btn-secondary" href="#menu">Browse menu</a>
      </div>
    </div>
  </div>
  <div class="container hero-highlights">
    <div class="highlight-card">
      <span>100+</span>
      <strong>African Dishes</strong>
      <p>Party rice, soups, and specials.</p>
    </div>
    <div class="highlight-card">
      <span>Fresh</span>
      <strong>Smoothies &amp; Juices</strong>
      <p>Cold-pressed and blended daily.</p>
    </div>
    <div class="highlight-card">
      <span>Events</span>
      <strong>Full-Service Catering</strong>
      <p>From small chops to big events.</p>
    </div>
    <div class="highlight-card">
      <span>YYC</span>
      <strong>Pickup &amp; Delivery</strong>
      <p>Choose your preferred time.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="section-title">How Ordering Works</h2>
    <p class="section-subtitle">Fast, simple, and built for mobile. Order African food in Calgary in three easy steps.</p>
    <div class="steps">
      <div class="step-card">
        <div class="step-number">1</div>
        <h3>Pick items + quantities</h3>
        <p>Browse the menu, choose your favorite dishes, and set portions that fit your appetite.</p>
      </div>
      <div class="step-card">
        <div class="step-number">2</div>
        <h3>Choose pickup or delivery</h3>
        <p>Select pickup or delivery and tell us your preferred time window in Calgary.</p>
      </div>
      <div class="step-card">
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
  </div>
</section>

<section id="catering" class="section">
  <div class="container">
    <h2 class="section-title">Catering Packages</h2>
    <p class="section-subtitle">Corporate catering in Calgary, wedding catering, birthdays, and gatherings with flexible packages.</p>
    <div class="packages">
      <div class="package-card">
        <h3>Small Gathering (5-10 people)</h3>
        <p>Two rice dishes, one stew, grilled protein, and sides with sauces.</p>
        <strong>Starting at $150</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking')); ?>">Book This Package</a>
      </div>
      <div class="package-card">
        <h3>Family Tray (10-20 people)</h3>
        <p>Expanded menu with jollof, fried rice, soups, and assorted small chops.</p>
        <strong>Starting at $300</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking')); ?>">Book This Package</a>
      </div>
      <div class="package-card">
        <h3>Event Catering (20-100+ people)</h3>
        <p>Full-service options, custom menu, and staffing support for large events.</p>
        <strong>Starting at $500 (Custom quotes available)</strong>
        <a class="btn btn-primary" href="<?php echo esc_url(home_url('/booking')); ?>">Book This Package</a>
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
        <h3>Stews &amp; Sauces</h3>
        <ul>
          <li>Red Stew</li>
          <li>Gizdodo (gizzard and dodo)</li>
          <li>Ayamase / Ofada Stew</li>
          <li>Banga Soup (Ofe Akwu)</li>
        </ul>
      </div>
      <div class="featured-card">
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

<section id="smoothies" class="section">
  <div class="container">
    <h2 class="section-title">Smoothies &amp; Fresh Juices</h2>
    <p class="section-subtitle">Freshly blended smoothies and traditional African beverages to complete your order.</p>
    <div class="drink-carousel" data-carousel>
      <button class="carousel-btn prev" type="button" aria-label="Scroll drinks left" data-carousel-prev>&lsaquo;</button>
      <div class="drink-grid" data-carousel-track data-drag-track>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80" alt="Tropical mango smoothie - DA Catering YYC" loading="lazy">
        <h3>Tropical Mango Smoothie</h3>
        <p>Mango, banana, and coconut.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$6-$9</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?auto=format&fit=crop&w=1200&q=80" alt="Pineapple ginger smoothie - DA Catering YYC" loading="lazy">
        <h3>Pineapple Ginger Zing</h3>
        <p>Pineapple, ginger, lime.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$6-$9</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?auto=format&fit=crop&w=1200&q=80" alt="Watermelon cooler drink - DA Catering YYC" loading="lazy">
        <h3>Watermelon Cooler</h3>
        <p>Watermelon, mint, lime.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$6-$9</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&w=1200&q=80" alt="Orange carrot boost juice - DA Catering YYC" loading="lazy">
        <h3>Orange Carrot Boost</h3>
        <p>Orange, carrot, turmeric.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$6-$9</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1506084868230-bb9d95c24759?auto=format&fit=crop&w=1200&q=80" alt="Berry blast smoothie - DA Catering YYC" loading="lazy">
        <h3>Berry Blast</h3>
        <p>Mixed berries, yogurt, honey.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$6-$9</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1502741224143-90386d7f8c82?auto=format&fit=crop&w=1200&q=80" alt="Zobo hibiscus drink - DA Catering YYC" loading="lazy">
        <h3>Zobo / Hibiscus Drink</h3>
        <p>Traditional Nigerian hibiscus infusion.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$5-$8</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1507914372368-b2b085b925a1?auto=format&fit=crop&w=1200&q=80" alt="Kunu tigernut drink - DA Catering YYC" loading="lazy">
        <h3>Kunu / Tigernut Drink</h3>
        <p>Creamy tigernut beverage with spice.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$5-$8</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="Chapman non-alcoholic cocktail - DA Catering YYC" loading="lazy">
        <h3>Chapman</h3>
        <p>Nigerian non-alcoholic cocktail with citrus.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$5-$8</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
      <div class="drink-card">
        <img src="https://images.unsplash.com/photo-1502741224143-90386d7f8c82?auto=format&fit=crop&w=1200&q=80" alt="Sobolo Ghanaian hibiscus drink - DA Catering YYC" loading="lazy">
        <h3>Sobolo</h3>
        <p>Ghanaian hibiscus drink with pineapple notes.</p>
        <p>Sizes: Small, Medium, Large</p>
        <strong>$5-$8</strong>
        <button class="btn btn-primary" type="button">Add Drinks to My Order</button>
      </div>
    </div>
      <button class="carousel-btn next" type="button" aria-label="Scroll drinks right" data-carousel-next>&rsaquo;</button>
    </div>
  </div>
</section>
<section id="video" class="section">
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

<section id="instagram" class="section instagram-section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Instagram Highlights</h2>
      <p class="section-subtitle">Follow @dacateringyyc for the latest dishes, events, and behind-the-scenes moments.</p>
    </div>
    <div class="instagram-carousel" data-carousel>
      <button class="carousel-btn prev" type="button" aria-label="Scroll Instagram left" data-carousel-prev>&lsaquo;</button>
      <div class="instagram-track" data-carousel-track data-drag-track>
        <article class="instagram-post">
          <div class="instagram-header">
            <div class="instagram-user">
              <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=200&q=80" alt="Instagram avatar" loading="lazy">
              <span>raisedbydocs</span>
            </div>
            <span class="instagram-menu">...</span>
          </div>
          <img class="instagram-photo" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=80" alt="African catering platter - DA Catering Calgary" loading="lazy">
          <div class="instagram-actions">
            <span>Like</span>
            <span>Comment</span>
            <span>Share</span>
          </div>
          <p class="instagram-caption"><strong>@dacateringyyc</strong> Family-style catering that keeps everyone coming back.</p>
        </article>
        <article class="instagram-post">
          <div class="instagram-header">
            <div class="instagram-user">
              <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=200&q=80" alt="Instagram avatar" loading="lazy">
              <span>maygrenna</span>
            </div>
            <span class="instagram-menu">...</span>
          </div>
          <img class="instagram-photo" src="https://images.unsplash.com/photo-1526318896980-cf78c088247c?auto=format&fit=crop&w=1200&q=80" alt="African stew and sides - Nigerian catering Calgary" loading="lazy">
          <div class="instagram-actions">
            <span>Like</span>
            <span>Comment</span>
            <span>Share</span>
          </div>
          <p class="instagram-caption"><strong>@dacateringyyc</strong> Weeknight plates that taste like home.</p>
        </article>
        <article class="instagram-post">
          <div class="instagram-header">
            <div class="instagram-user">
              <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=200&q=80" alt="Instagram avatar" loading="lazy">
              <span>cliffpavlovic</span>
            </div>
            <span class="instagram-menu">...</span>
          </div>
          <img class="instagram-photo" src="https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=1200&q=80" alt="Suya skewers - African food delivery YYC" loading="lazy">
          <div class="instagram-actions">
            <span>Like</span>
            <span>Comment</span>
            <span>Share</span>
          </div>
          <p class="instagram-caption"><strong>@dacateringyyc</strong> Suya skewers served fresh and spicy.</p>
        </article>
        <article class="instagram-post">
          <div class="instagram-header">
            <div class="instagram-user">
              <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=200&q=80" alt="Instagram avatar" loading="lazy">
              <span>goodfoodca</span>
            </div>
            <span class="instagram-menu">...</span>
          </div>
          <img class="instagram-photo" src="https://images.unsplash.com/photo-1505252585461-04db1eb84625?auto=format&fit=crop&w=1200&q=80" alt="Fresh juice and smoothie lineup - DA Catering YYC" loading="lazy">
          <div class="instagram-actions">
            <span>Like</span>
            <span>Comment</span>
            <span>Share</span>
          </div>
          <p class="instagram-caption"><strong>@dacateringyyc</strong> Smoothies and juices to finish strong.</p>
        </article>
      </div>
      <button class="carousel-btn next" type="button" aria-label="Scroll Instagram right" data-carousel-next>&rsaquo;</button>
    </div>
    <div class="instagram-footer">
      <a class="btn btn-primary" href="https://instagram.com/dacateringyyc" target="_blank" rel="noopener">See More on Instagram</a>
    </div>
  </div>
</section>

<section id="reviews" class="section">
  <div class="container">
    <h2 class="section-title">Reviews</h2>
    <p class="section-subtitle">Honest feedback from Calgary families, corporate teams, and event planners.</p>
    <div class="testimonial-grid" data-drag-track>
      <div class="testimonial-card">
        <span>★★★★★</span>
        <strong>Nadia M. - Downtown</strong>
        <p>The jollof rice and suya were a hit at our office lunch. Delivery arrived right on time and was still hot.</p>
      </div>
      <div class="testimonial-card">
        <span>★★★★★</span>
        <strong>Kola A. - Beltline</strong>
        <p>We ordered egusi with pounded yam for a family dinner. The flavors tasted like home and portions were generous.</p>
      </div>
      <div class="testimonial-card">
        <span>★★★★☆</span>
        <strong>Stephanie R. - Sage Hill</strong>
        <p>Booking for our graduation celebration was simple. They were responsive on WhatsApp and handled dietary notes well.</p>
      </div>
      <div class="testimonial-card">
        <span>★★★★★</span>
        <strong>Yaw K. - Airdrie</strong>
        <p>The catering trays were perfect for our memorial service. Everything was packed neatly and labeled.</p>
      </div>
      <div class="testimonial-card">
        <span>★★★★★</span>
        <strong>Fatima L. - Tuscany</strong>
        <p>Fresh smoothies and zobo were refreshing. Loved the variety of menu options for vegetarians.</p>
      </div>
      <div class="testimonial-card">
        <span>★★★★☆</span>
        <strong>Chris P. - University District</strong>
        <p>Great value for the family tray and clear pickup instructions. We will order again for birthdays.</p>
      </div>
    </div>
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
