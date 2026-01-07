# DA Catering YYC WordPress Setup

## Upload Themes
- Zip `da-catering-yyc` and `da-catering-yyc-child`.
- In WP Admin: Appearance -> Themes -> Add New -> Upload Theme.
- Install both, activate `DA Catering YYC Child`.

## Pages
- Create a page named `Home` and set Template: **Home Page**.
- Create a page named `Booking` with slug `booking` and set Template: **Booking Page**.
- Settings -> Reading -> set **Homepage** to `Home`.

## Forms (WPForms)
- Install and activate WPForms Lite.
- Create two forms:
  - Form ID 1: Catering Booking Form
  - Form ID 2: Order Submission / Checkout
- Update the IDs in `da-catering-yyc/templates/booking.php` if your IDs differ.

If WPForms is not installed, the theme falls back to the built-in HTML forms.

## WooCommerce + Stripe (Option 2)
- Install and activate **WooCommerce**.
- Go to WooCommerce -> Settings -> Payments and enable **Stripe**.
  - Install **WooCommerce Stripe Gateway** if Stripe is not listed.
- Create products for each menu item (price, image, description).
- Create product categories (Rice Dishes, Swallows, Stews, Small Chops, Proteins, Vegetarian, Smoothies, Juices, Party Trays).
- The **Shop** page becomes your live ordering + checkout flow.
- The “Place Order Now” button now links to `/shop`.

## Automations (Zapier/Make + Twilio + SendGrid)
- Set WPForms to send webhooks to Zapier/Make.
- Create rows in Google Sheets or Airtable.
- Send email notifications to the business.
- Send SMS to the business via Twilio.
- Send email + SMS confirmations to customers.

## Contact Placeholders
Current placeholders:
- Email: steph.omotayo@gmail.com
- Phone/WhatsApp: +1 (403) 478-2475

Search and replace these when you're ready to switch to the final contact details.
