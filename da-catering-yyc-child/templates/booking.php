<div class="booking-modern">
  <section class="booking-hero">
    <div class="booking-hero__container">
      <span class="booking-hero__badge">
        <span class="badge-pulse"></span>
        Now Accepting Bookings
      </span>
      <h1 class="booking-hero__title">
        Book Your <span class="text-gradient">Perfect Event</span>
      </h1>
      <p class="booking-hero__subtitle">
        From intimate gatherings to grand celebrations, we bring authentic African flavors<br/>
        to your table with exceptional service.
      </p>
    </div>
  </section>

  <section class="booking-tabs">
    <div class="booking-tabs__container">
      <div class="tabs-wrapper">
        <button class="tab-btn active" data-tab="catering" type="button">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
          </svg>
          <span>Catering Booking</span>
        </button>
        <button class="tab-btn" data-tab="quick-order" type="button">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"/>
            <circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <span>Quick Order</span>
        </button>
      </div>
    </div>
  </section>

  <section class="booking-content">
    <div class="booking-content__container">
      <div class="tab-panel active" data-panel="catering">
        <div class="booking-grid">
          <div class="booking-form-wrapper">
            <form class="booking-form" id="cateringForm">
              <div class="form-steps">
                <div class="step-item active" data-step="1">
                  <div class="step-circle">
                    <span class="step-number">1</span>
                    <svg class="step-check" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <span class="step-label">Event Details</span>
                </div>
                <div class="step-divider"></div>
                <div class="step-item" data-step="2">
                  <div class="step-circle">
                    <span class="step-number">2</span>
                    <svg class="step-check" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <span class="step-label">Contact Info</span>
                </div>
                <div class="step-divider"></div>
                <div class="step-item" data-step="3">
                  <div class="step-circle">
                    <span class="step-number">3</span>
                    <svg class="step-check" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <span class="step-label">Preferences</span>
                </div>
                <div class="step-divider"></div>
                <div class="step-item" data-step="4">
                  <div class="step-circle">
                    <span class="step-number">4</span>
                    <svg class="step-check" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <span class="step-label">Confirm</span>
                </div>
              </div>

              <div class="form-step active" data-step-content="1">
                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Event Details</h3>
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Event Type *</label>
                      <select class="form-select" name="event_type" required>
                        <option value="">Select event type</option>
                        <option value="wedding">Wedding Reception</option>
                        <option value="corporate">Corporate Event</option>
                        <option value="birthday">Birthday Party</option>
                        <option value="anniversary">Anniversary</option>
                        <option value="graduation">Graduation</option>
                        <option value="other">Other Celebration</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="form-label">Number of Guests *</label>
                      <select class="form-select" name="guest_count" required>
                        <option value="">Select guest range</option>
                        <option value="10-25">10-25 guests</option>
                        <option value="25-50">25-50 guests</option>
                        <option value="50-100">50-100 guests</option>
                        <option value="100-200">100-200 guests</option>
                        <option value="200+">200+ guests</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Event Date *</label>
                      <input type="date" class="form-input" name="event_date" required />
                    </div>

                    <div class="form-group">
                      <label class="form-label">Event Time *</label>
                      <input type="time" class="form-input" name="event_time" required />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Budget Range (Optional)</label>
                    <select class="form-select" name="budget_range">
                      <option value="">Select budget range</option>
                      <option value="under-1000">Under $1,000</option>
                      <option value="1000-2500">$1,000 - $2,500</option>
                      <option value="2500-5000">$2,500 - $5,000</option>
                      <option value="5000-10000">$5,000 - $10,000</option>
                      <option value="10000+">$10,000+</option>
                    </select>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                    Continue to Contact Info
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </button>
                </div>
              </div>

              <div class="form-step" data-step-content="2">
                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Contact Information</h3>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-input" name="full_name" placeholder="John Doe" required />
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Email Address *</label>
                      <input type="email" class="form-input" name="email" placeholder="john@example.com" required />
                    </div>

                    <div class="form-group">
                      <label class="form-label">Phone Number *</label>
                      <input type="tel" class="form-input" name="phone" placeholder="(403) 000-0000" required />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Preferred Contact Method</label>
                    <div class="checkbox-group">
                      <label class="checkbox-label">
                        <input type="checkbox" name="contact_method" value="whatsapp" />
                        <span class="checkbox-custom"></span>
                        <span>WhatsApp</span>
                      </label>
                      <label class="checkbox-label">
                        <input type="checkbox" name="contact_method" value="phone" />
                        <span class="checkbox-custom"></span>
                        <span>Phone</span>
                      </label>
                      <label class="checkbox-label">
                        <input type="checkbox" name="contact_method" value="email" />
                        <span class="checkbox-custom"></span>
                        <span>Email</span>
                      </label>
                      <label class="checkbox-label">
                        <input type="checkbox" name="contact_method" value="sms" />
                        <span class="checkbox-custom"></span>
                        <span>SMS</span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back
                  </button>
                  <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                    Continue to Preferences
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </button>
                </div>
              </div>

              <div class="form-step" data-step-content="3">
                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Service Details</h3>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Service Type *</label>
                    <div class="radio-cards">
                      <label class="radio-card">
                        <input type="radio" name="service_type" value="pickup" required />
                        <div class="radio-card__content">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 17h14v-2H5v2zm0-6h14V9H5v2zm0-6v2h14V5H5z"/>
                          </svg>
                          <div>
                            <strong>Pickup</strong>
                            <span>Collect your order at our location</span>
                          </div>
                        </div>
                        <span class="radio-check"></span>
                      </label>

                      <label class="radio-card">
                        <input type="radio" name="service_type" value="delivery" />
                        <div class="radio-card__content">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"/>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                          </svg>
                          <div>
                            <strong>Delivery</strong>
                            <span>We deliver to your event location</span>
                          </div>
                        </div>
                        <span class="radio-check"></span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group delivery-address" style="display: none;">
                    <label class="form-label">Delivery Address</label>
                    <textarea class="form-textarea" name="delivery_address" rows="3" placeholder="Street address, unit, postal code"></textarea>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Special Delivery Instructions</label>
                    <textarea class="form-textarea" name="delivery_instructions" rows="3" placeholder="Gate code, parking notes, setup instructions..."></textarea>
                  </div>
                </div>

                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Additional Information</h3>
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Dietary Restrictions & Allergies</label>
                      <textarea class="form-textarea" name="dietary_restrictions" rows="4" placeholder="Please list any allergies or dietary restrictions"></textarea>
                    </div>

                    <div class="form-group">
                      <label class="form-label">Special Requests</label>
                      <textarea class="form-textarea" name="special_requests" rows="4" placeholder="Menu preferences, setup requirements, cultural notes..."></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back
                  </button>
                  <button type="button" class="btn btn-primary" onclick="nextStep(4)">
                    Review & Confirm
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </button>
                </div>
              </div>

              <div class="form-step" data-step-content="4">
                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Review Your Booking</h3>
                  </div>

                  <div class="info-callout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                      <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <div>
                      <strong>What Happens Next?</strong>
                      <p>After you submit, we'll confirm your booking within 2 hours via your preferred contact method. You'll receive a detailed quote and menu options tailored to your event.</p>
                    </div>
                  </div>

                  <div class="booking-summary"></div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back
                  </button>
                  <button type="submit" class="btn btn-primary btn-submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Submit Booking Request
                  </button>
                  <button type="button" class="btn btn-secondary" onclick="sendWhatsApp()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Send via WhatsApp
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div class="booking-sidebar">
            <div class="sidebar-card sticky">
              <div class="sidebar-header">
                <h3>Why Book With Us?</h3>
              </div>

              <div class="sidebar-benefits">
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <div>
                    <strong>Authentic African Cuisine</strong>
                    <p>Traditional recipes passed down through generations</p>
                  </div>
                </div>

                <div class="benefit-item">
                  <div class="benefit-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <div>
                    <strong>Flexible Packages</strong>
                    <p>Customizable menus for any event size</p>
                  </div>
                </div>

                <div class="benefit-item">
                  <div class="benefit-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <div>
                    <strong>Professional Service</strong>
                    <p>Experienced staff ensuring seamless execution</p>
                  </div>
                </div>

                <div class="benefit-item">
                  <div class="benefit-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  </div>
                  <div>
                    <strong>Quick Response</strong>
                    <p>Quote and confirmation within 2 hours</p>
                  </div>
                </div>
              </div>

              <div class="sidebar-cta">
                <p class="sidebar-cta__text">Need help deciding?</p>
                <a href="tel:+14034782475" class="sidebar-cta__link">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                  </svg>
                  Call (403) 478-2475
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-panel" data-panel="quick-order">
        <div class="quick-order-content">
          <div class="quick-order-header">
            <h2>Quick Order Checkout</h2>
            <p>Complete your order in minutes</p>
          </div>

          <div class="booking-grid">
            <div class="booking-form-wrapper">
              <form class="booking-form" id="checkoutForm">
                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Contact Information</h3>
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Full Name *</label>
                      <input type="text" class="form-input" name="order_name" placeholder="Your name" required />
                    </div>
                    <div class="form-group">
                      <label class="form-label">Email *</label>
                      <input type="email" class="form-input" name="order_email" placeholder="your@email.com" required />
                    </div>
                    <div class="form-group">
                      <label class="form-label">Phone *</label>
                      <input type="tel" class="form-input" name="order_phone" placeholder="(403) 000-0000" required />
                    </div>
                  </div>
                </div>

                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Fulfillment</h3>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Pickup or Delivery *</label>
                    <div class="radio-cards">
                      <label class="radio-card">
                        <input type="radio" name="fulfillment" value="pickup" checked />
                        <div class="radio-card__content">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 17h14v-2H5v2zm0-6h14V9H5v2zm0-6v2h14V5H5z"/>
                          </svg>
                          <div>
                            <strong>Pickup</strong>
                            <span>Collect your order at our location</span>
                          </div>
                        </div>
                        <span class="radio-check"></span>
                      </label>

                      <label class="radio-card">
                        <input type="radio" name="fulfillment" value="delivery" />
                        <div class="radio-card__content">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"/>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                          </svg>
                          <div>
                            <strong>Delivery</strong>
                            <span>We deliver to your address</span>
                          </div>
                        </div>
                        <span class="radio-check"></span>
                      </label>
                    </div>
                  </div>

                  <div class="form-grid grid-2">
                    <div class="form-group">
                      <label class="form-label">Preferred Time *</label>
                      <input type="datetime-local" class="form-input" name="order_time" required />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Delivery Address</label>
                    <textarea class="form-textarea" name="delivery_address" rows="3" placeholder="Required for delivery" data-delivery-field></textarea>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Order Notes</label>
                    <textarea class="form-textarea" name="order_notes" rows="3" placeholder="Spice level, prep notes, gift message"></textarea>
                  </div>
                </div>

                <div class="form-section">
                  <div class="section-header">
                    <span class="section-icon"></span>
                    <h3 class="section-title">Payment Method</h3>
                  </div>

                  <div class="radio-cards">
                    <label class="radio-card">
                      <input type="radio" name="payment" value="pickup" checked />
                      <div class="radio-card__content">
                        <div>
                          <strong>Pay on Pickup</strong>
                          <span>Pay when you arrive</span>
                        </div>
                      </div>
                      <span class="radio-check"></span>
                    </label>
                    <label class="radio-card">
                      <input type="radio" name="payment" value="delivery" />
                      <div class="radio-card__content">
                        <div>
                          <strong>Pay on Delivery</strong>
                          <span>Pay at drop-off</span>
                        </div>
                      </div>
                      <span class="radio-check"></span>
                    </label>
                    <label class="radio-card">
                      <input type="radio" name="payment" value="etransfer" />
                      <div class="radio-card__content">
                        <div>
                          <strong>Interac e-Transfer</strong>
                          <span>Send payment securely</span>
                        </div>
                      </div>
                      <span class="radio-check"></span>
                    </label>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary btn-submit">
                    Place Order
                  </button>
                  <a href="https://wa.me/14034782475" class="btn btn-secondary" data-order-whatsapp>
                    Send to WhatsApp
                  </a>
                  <button type="button" class="btn btn-secondary" data-clear-order>
                    Clear Order
                  </button>
                </div>
              </form>
            </div>

            <div class="booking-sidebar">
              <div class="sidebar-card sticky">
                <div class="sidebar-header">
                  <h3>Your Order</h3>
                </div>
                <div class="order-summary-box">
                  <div data-order-summary>
                    <p class="booking-empty">
                      Your order is empty. <a href="<?php echo esc_url(home_url('/')); ?>#menu" class="booking-link">Browse our menu</a> to add items.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
