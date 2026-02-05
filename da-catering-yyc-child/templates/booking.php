<div class="bg-animation">
  <div class="bg-gradient-orb orb-1"></div>
  <div class="bg-gradient-orb orb-2"></div>
  <div class="bg-gradient-orb orb-3"></div>
</div>

<div class="main-container">
  <div class="hero-booking">
    <div class="hero-badge">Now Booking Events</div>
    <h1 class="hero-title">Book Your Perfect Event</h1>
    <p class="hero-subtitle">From intimate gatherings to grand celebrations, we bring authentic African flavors to your table with exceptional service.</p>
  </div>

  <div class="tab-nav">
    <button class="tab-btn active" data-tab="catering">
      Catering Booking
    </button>
    <button class="tab-btn" data-tab="checkout">
      Quick Order Checkout
    </button>
  </div>

  <div class="tab-content active" id="catering">
    <div class="glass-card fade-in-up">
      <div class="progress-steps">
        <div class="progress-step">
          <div class="step-circle active">1</div>
          <span class="step-label">Event Details</span>
        </div>
        <div class="progress-step">
          <div class="step-circle">2</div>
          <span class="step-label">Contact Info</span>
        </div>
        <div class="progress-step">
          <div class="step-circle">3</div>
          <span class="step-label">Preferences</span>
        </div>
        <div class="progress-step">
          <div class="step-circle">4</div>
          <span class="step-label">Confirm</span>
        </div>
      </div>

      <form id="cateringForm">
        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Event Details
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Event Type <span class="required">*</span></label>
              <select required>
                <option value="">Select event type</option>
                <option>Corporate Lunch/Meeting</option>
                <option>Birthday Party</option>
                <option>Wedding Reception</option>
                <option>Graduation Celebration</option>
                <option>Baby Shower</option>
                <option>Funeral/Memorial</option>
                <option>Community Gathering</option>
                <option>Private Dinner</option>
                <option>Holiday Celebration</option>
                <option>Other</option>
              </select>
            </div>
            <div class="form-group">
              <label>Event Date <span class="required">*</span></label>
              <input type="date" required>
            </div>
            <div class="form-group">
              <label>Event Time <span class="required">*</span></label>
              <input type="time" required>
            </div>
            <div class="form-group">
              <label>Number of Guests <span class="required">*</span></label>
              <select required>
                <option value="">Select range</option>
                <option>5-10 guests</option>
                <option>10-20 guests</option>
                <option>20-30 guests</option>
                <option>30-50 guests</option>
                <option>50-75 guests</option>
                <option>75-100 guests</option>
                <option>100+ guests</option>
              </select>
            </div>
            <div class="form-group">
              <label>Budget Range</label>
              <select>
                <option value="">Select budget (optional)</option>
                <option>Under $200</option>
                <option>$200-$500</option>
                <option>$500-$1,000</option>
                <option>$1,000-$2,000</option>
                <option>$2,000-$5,000</option>
                <option>$5,000+</option>
                <option>Flexible</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Contact Information
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name <span class="required">*</span></label>
              <input type="text" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label>Email Address <span class="required">*</span></label>
              <input type="email" placeholder="john@example.com" required>
            </div>
            <div class="form-group">
              <label>Phone Number <span class="required">*</span></label>
              <input type="tel" placeholder="(403) 000-0000" required>
            </div>
            <div class="form-group">
              <label>Preferred Contact Method</label>
              <div class="checkbox-group">
                <label class="checkbox-label">
                  <input type="checkbox"> WhatsApp
                </label>
                <label class="checkbox-label">
                  <input type="checkbox"> Phone
                </label>
                <label class="checkbox-label">
                  <input type="checkbox"> Email
                </label>
                <label class="checkbox-label">
                  <input type="checkbox"> SMS
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Service Details
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Service Type <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="service" value="pickup" checked> Pickup
                </label>
                <label class="radio-label">
                  <input type="radio" name="service" value="delivery"> Delivery
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Delivery Address</label>
              <textarea placeholder="Street address, unit, postal code"></textarea>
            </div>
            <div class="form-group">
              <label>Special Delivery Instructions</label>
              <textarea placeholder="Gate code, buzzer, parking notes"></textarea>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Additional Information
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Dietary Restrictions &amp; Allergies</label>
              <textarea placeholder="Please list any allergies or dietary restrictions"></textarea>
            </div>
            <div class="form-group">
              <label>Special Requests</label>
              <textarea placeholder="Menu preferences, setup requirements, cultural notes"></textarea>
            </div>
          </div>
        </div>

        <div class="info-callout">
          <h4>✨ What Happens Next?</h4>
          <p>After you submit, we'll confirm your booking within 2 hours via your preferred contact method. You'll receive a detailed quote and menu options tailored to your event.</p>
        </div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">
            Submit Booking Request →
          </button>
          <a href="https://wa.me/14034782475?text=Hi%20DA%20Catering,%20I'd%20like%20to%20book%20catering" class="btn btn-secondary">
            Send via WhatsApp
          </a>
        </div>
      </form>
    </div>
  </div>

  <div class="tab-content" id="checkout">
    <div class="glass-card fade-in-up">
      <form id="checkoutForm">
        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Your Order
          </h3>
          <div class="order-summary-box">
            <div data-order-summary>
              <p class="booking-empty">
                Your order is empty. <a href="<?php echo esc_url(home_url('/')); ?>#menu" class="booking-link">Browse our menu</a> to add items.
              </p>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Contact Information
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name <span class="required">*</span></label>
              <input type="text" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label>Email <span class="required">*</span></label>
              <input type="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
              <label>Phone <span class="required">*</span></label>
              <input type="tel" placeholder="(403) 000-0000" required>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Fulfillment
          </h3>
          <div class="form-grid">
            <div class="form-group">
              <label>Pickup or Delivery <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="fulfillment" value="pickup" checked> Pickup
                </label>
                <label class="radio-label">
                  <input type="radio" name="fulfillment" value="delivery"> Delivery
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Preferred Time <span class="required">*</span></label>
              <input type="datetime-local" required>
            </div>
            <div class="form-group">
              <label>Delivery Address</label>
              <textarea placeholder="Required for delivery" data-delivery-field></textarea>
            </div>
            <div class="form-group">
              <label>Order Notes</label>
              <textarea placeholder="Spice level, prep notes, gift message"></textarea>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3 class="form-section-title">
            <span class="section-icon"></span>
            Payment Method
          </h3>
          <div class="radio-group">
            <label class="radio-label">
              <input type="radio" name="payment" value="pickup" checked> Pay on Pickup
            </label>
            <label class="radio-label">
              <input type="radio" name="payment" value="delivery"> Pay on Delivery
            </label>
            <label class="radio-label">
              <input type="radio" name="payment" value="etransfer"> Interac e-Transfer
            </label>
            <label class="radio-label">
              <input type="radio" name="payment" value="card"> Credit Card
            </label>
          </div>
        </div>

        <div class="btn-group">
          <button type="submit" class="btn btn-primary">
            Place Order →
          </button>
          <a href="https://wa.me/14034782475" class="btn btn-secondary" data-order-whatsapp>
            Send to WhatsApp
          </a>
          <button type="button" class="btn btn-outline" data-clear-order>
            Clear Order
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
