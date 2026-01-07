
<section class="section">
  <div class="container">
    <span class="badge">Booking + Checkout</span>
    <h1 class="section-title">Book Catering or Submit Your Order</h1>
    <p class="section-subtitle">Tell us about your event or submit your order details. We will confirm by WhatsApp, email, and SMS.</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="#booking">Submit Booking Request</a>
      <a class="btn btn-secondary" href="#checkout">Go to Checkout</a>
    </div>
  </div>
</section>

<section id="booking" class="section accent">
  <div class="container">
    <h2 class="section-title">Catering Booking Form</h2>
    <?php if (shortcode_exists('wpforms')) : ?>
      <?php echo do_shortcode('[wpforms id="1" title="false" description="false"]'); ?>
    <?php else : ?>
    <form>
      <div class="form-grid">
        <div>
          <label for="full-name">Full Name *</label>
          <input id="full-name" type="text" placeholder="Your full name" required>
        </div>
        <div>
          <label for="email">Email Address *</label>
          <input id="email" type="email" placeholder="you@email.com" required>
        </div>
        <div>
          <label for="phone">Phone Number *</label>
          <input id="phone" type="tel" placeholder="(403) 478-2475" required>
        </div>
        <div>
          <label for="event-type">Event Type *</label>
          <select id="event-type" required>
            <option value="">Select event type</option>
            <option>Corporate Lunch/Meeting</option>
            <option>Birthday Party</option>
            <option>Wedding Reception</option>
            <option>Graduation Celebration</option>
            <option>Baby Shower</option>
            <option>Funeral/Memorial Service</option>
            <option>Community Gathering</option>
            <option>Private Dinner Party</option>
            <option>Office Potluck</option>
            <option>Holiday Celebration</option>
            <option>Other</option>
          </select>
        </div>
        <div>
          <label for="event-date">Event Date *</label>
          <input id="event-date" type="date" required>
        </div>
        <div>
          <label for="event-time">Event Time *</label>
          <input id="event-time" type="time" required>
        </div>
        <div>
          <label for="guest-count">Number of Guests *</label>
          <select id="guest-count" required>
            <option value="">Select range</option>
            <option>5-10</option>
            <option>10-20</option>
            <option>20-30</option>
            <option>30-50</option>
            <option>50-75</option>
            <option>75-100</option>
            <option>100+</option>
          </select>
        </div>
        <div>
          <label for="budget">Budget Range</label>
          <select id="budget">
            <option value="">Select budget</option>
            <option>Under $200</option>
            <option>$200-$500</option>
            <option>$500-$1,000</option>
            <option>$1,000-$2,000</option>
            <option>$2,000-$5,000</option>
            <option>$5,000+</option>
            <option>Flexible/To Be Discussed</option>
          </select>
        </div>
        <div>
          <label for="delivery-option">Delivery vs Pickup *</label>
          <select id="delivery-option" data-delivery-toggle required>
            <option value="pickup">Pickup</option>
            <option value="delivery">Delivery</option>
          </select>
        </div>
      </div>
      <div class="form-grid" style="margin-top: 16px;">
        <div>
          <label for="dietary">Dietary Restrictions &amp; Allergy Notes</label>
          <textarea id="dietary" placeholder="Allergies, dietary restrictions, or special preparation notes"></textarea>
        </div>
        <div>
          <label for="delivery-address">Delivery Address</label>
          <textarea id="delivery-address" data-delivery-field placeholder="Full address with postal code"></textarea>
        </div>
        <div>
          <label for="delivery-notes">Special Delivery Instructions</label>
          <textarea id="delivery-notes" placeholder="Gate code, buzzer, drop-off notes"></textarea>
        </div>
        <div>
          <label>Preferred Contact Method</label>
          <div>
            <label><input type="checkbox"> WhatsApp</label>
            <label><input type="checkbox"> Phone Call</label>
            <label><input type="checkbox"> Email</label>
            <label><input type="checkbox"> Text/SMS</label>
          </div>
        </div>
        <div>
          <label for="additional-notes">Additional Notes or Special Requests</label>
          <textarea id="additional-notes" placeholder="Menu ideas, cultural preferences, service notes"></textarea>
        </div>
      </div>
      <div class="hero-actions" style="margin-top: 24px;">
        <button class="btn btn-primary" type="submit">Submit Booking Request</button>
        <a class="btn btn-secondary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I'd%20like%20to%20book%20catering%20for%20my%20event.%20Event%20type:%20____%20Date:%20____%20Guests:%20____%20My%20name%20is%20____" target="_blank" rel="noopener">Send Request via WhatsApp</a>
      </div>
    </form>
    <?php endif; ?>
  </div>
</section>
<section id="checkout" class="section">
  <div class="container">
    <h2 class="section-title">Order Submission / Checkout</h2>
    <?php if (shortcode_exists('wpforms')) : ?>
      <?php echo do_shortcode('[wpforms id="2" title="false" description="false"]'); ?>
    <?php else : ?>
    <div class="form-grid">
      <div>
        <label for="order-name">Full Name *</label>
        <input id="order-name" type="text" placeholder="Your full name" required>
      </div>
      <div>
        <label for="order-email">Email Address *</label>
        <input id="order-email" type="email" placeholder="you@email.com" required>
      </div>
      <div>
        <label for="order-email-confirm">Confirm Email *</label>
        <input id="order-email-confirm" type="email" placeholder="re-enter email" required>
      </div>
      <div>
        <label for="order-phone">Phone Number *</label>
        <input id="order-phone" type="tel" placeholder="(403) 478-2475" required>
      </div>
    </div>

    <div style="margin-top: 24px;">
      <h3>Order Summary</h3>
      <div class="order-summary" data-order-summary>
        <p>Your selected items will appear here. Add dishes from the menu to build your order.</p>
      </div>
      <div class="hero-actions" style="margin-top: 12px;">
        <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/')); ?>#menu">Edit Order</a>
        <button class="btn btn-outline" type="button" data-clear-order>Clear Order</button>
      </div>
    </div>

    <div class="form-grid" style="margin-top: 24px;">
      <div>
        <label>Pickup vs Delivery *</label>
        <div>
          <label><input type="radio" name="fulfillment" value="pickup" checked> Pickup</label>
          <label><input type="radio" name="fulfillment" value="delivery"> Delivery</label>
        </div>
      </div>
      <div>
        <label for="fulfillment-time">Preferred Pickup/Delivery Time *</label>
        <input id="fulfillment-time" type="datetime-local" required>
      </div>
      <div>
        <label for="delivery-address-checkout">Delivery Address</label>
        <textarea id="delivery-address-checkout" data-delivery-field placeholder="Street address, unit, Calgary, postal code"></textarea>
      </div>
      <div>
        <label for="delivery-notes-checkout">Delivery Instructions</label>
        <textarea id="delivery-notes-checkout" placeholder="Gate codes, buzzer, drop-off notes"></textarea>
      </div>
      <div>
        <label for="order-notes">Order Notes</label>
        <textarea id="order-notes" placeholder="Prep notes, spice level, gift message"></textarea>
      </div>
    </div>

    <div class="form-grid" style="margin-top: 24px;">
      <div>
        <label>Payment Method *</label>
        <div>
          <label><input type="radio" name="payment" value="pickup"> Pay on Pickup</label>
          <label><input type="radio" name="payment" value="delivery"> Pay on Delivery</label>
          <label><input type="radio" name="payment" value="etransfer"> Interac eTransfer</label>
          <label><input type="radio" name="payment" value="card"> Credit Card (if integrated)</label>
        </div>
      </div>
    </div>

    <div class="hero-actions" style="margin-top: 24px;">
      <a class="btn btn-primary" href="https://wa.me/14034782475?text=Hi%20DA%20Catering%20YYC,%20I'd%20like%20to%20place%20an%20order.%20My%20name%20is%20____%20and%20my%20order%20details%20are:%20____" target="_blank" rel="noopener" data-order-whatsapp>Send Order to WhatsApp</a>
      <button class="btn btn-secondary" type="submit">Submit Order</button>
      <button class="btn btn-outline" type="button">Save Order for Later</button>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="section accent">
  <div class="container">
    <h2 class="section-title">How Confirmations Work</h2>
    <div class="callout">
      <p><strong>For the business:</strong> Instant email notification with order/booking details, SMS alerts for time-sensitive requests, automatic logging to Google Sheets or Airtable, and reply-ready contact details.</p>
      <p><strong>For the customer:</strong> Immediate email confirmation with order summary, SMS confirmation with estimated pickup/delivery time, and status updates through the preferred contact method.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="section-title">Developer Notes: Automation Setup</h2>
    <div class="callout">
      <p>Workflow example using Zapier or Make (Integromat) with Twilio and SendGrid:</p>
      <ol>
        <li>Customer submits form on WordPress/Webflow.</li>
        <li>Form webhook triggers Zapier/Make scenario.</li>
        <li>Automation creates a row in Google Sheets or Airtable.</li>
        <li>Automation emails the business inbox with order/booking details.</li>
        <li>Automation sends SMS alerts to the business phone via Twilio.</li>
        <li>Automation sends confirmation email to the customer via SendGrid/Mailgun.</li>
        <li>Automation sends confirmation SMS to the customer via Twilio.</li>
      </ol>
    </div>
  </div>
</section>

