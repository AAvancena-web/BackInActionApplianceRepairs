# Back In Action Appliance Repairs

A custom WordPress theme for **Back In Action Appliance Repairs**, a new Melbourne business that repairs washing machines, dryers and dishwashers. It follows the structure of the Metro Household Appliance Repairs landing page, but the look is its own: the navy, amber and slate from the Back In Action logo, a turning arrow motif taken from the logo mark, rounded tiles, and custom appliance illustrations.

**Preview:** https://aavancena-web.github.io/BackInActionApplianceRepairs/ (the static build lives in `docs/`; a root `index.html` forwards to it, so GitHub Pages works with either the root or `/docs` folder setting).

## Install

1. Download `bia-theme.zip` from this repository. You can also zip the `bia-theme` folder yourself.
2. In WordPress, go to **Appearance > Themes > Add New > Upload Theme**, then upload and activate it.
3. When you activate the theme, it does a one-time setup:
   - Creates the pages: Home, About, Washing Machine Repairs, Dryer Repairs, Dishwasher Repairs and Contact. Pages that already exist are kept.
   - Assigns the right template to each page.
   - Sets Home as the static front page and uses `/%postname%/` permalinks (if none are set).
   - Builds the menu: Home, About, Washing Machine Repairs, Dryer Repairs, Dishwasher Repairs, Contact.
4. Go to **Appearance > Customize > Back In Action Settings** and set the phone, email, service area, hours, ABN, map, form recipient and social links.

## Details still to confirm (TBC)

These are placeholders. Change them in the Customizer, not in code:

| Setting | Placeholder |
| --- | --- |
| Phone | 0400 000 000 |
| Email | hello@yourdomain.com.au |
| Service area | Melbourne metro (taken from the logo) |
| Hours | Mon to Sat, 7am to 6pm |
| Domain | Not needed by the theme. Set it in WordPress. |

The client should also check these claims in the copy (`inc/data.php`): same day and next day bookings, the workmanship guarantee, parts carried in the van, and the brands list. **Reviews are hidden** until real reviews are added to `bia_reviews()` in `inc/data.php`. No made-up testimonials ship with the theme.

## Page structure

- **Home (landing page):** hero with the H1, CTAs and a booking form on the right; a trust strip; three service cards; an about intro with the family story; common faults for each appliance; how it works in 4 steps; a brands marquee; why choose us; service area; reviews (when added); FAQs; a CTA band; then the global contact section.
- **Service pages (x3):** hero with a booking form (the appliance is preselected), intro, common faults, what's included, repair or replace advice, process, brands, FAQs for that appliance, other services and a CTA.
- **About:** story, values, services, process and a CTA.
- **Contact:** contact cards, map, booking form, service area and FAQs.

## Structure

```
bia-theme/
  header.php / footer.php        Global header and footer (footer includes the pre-footer contact section)
  front-page.php                 Homepage (landing page layout)
  page.php, index.php, 404.php
  page-templates/
    template-service.php         Service page (content matched by slug)
    template-about.php           About
    template-contact.php         Contact
  template-parts/                Page hero, contact section, CTA band, FAQ, service cards, process, brands, trust strip, reviews
  inc/
    data.php                     All site copy
    forms.php                    Built-in booking and contact forms (wp_mail)
    customizer.php               Theme settings
    activation.php               One-time page, menu and front page setup
    illustrations.php            Inline SVG appliance illustrations
    menus.php, helpers.php, icons.php, setup.php
  assets/css/main.css, assets/js/main.js, assets/fonts (Outfit + Manrope, self-hosted), assets/img (logos, favicon)
design-assets/logos/             Original logo files supplied by the client
build/                           Renders the theme to static HTML in docs/ (php build/build-static.php)
docs/                            Static preview
```

## Build rules followed

- **Header:** a circular phone icon with a navy fill and a light border sits to the left of the hamburger. On desktop it also shows the number.
- **Mobile:** a floating "Call now" button sits at the bottom centre of the screen.
- **Banner:** the H1, paragraph and CTAs sit on the left, with a booking form on the right. The banner content shows straight away with no reveal animation.
- **Above the footer:** a global section with contact cards, a Google Map embed (no API key needed) and the booking form. It is hidden on the Contact page because that page already shows it.
- **Widths:** the container is a max of 1440px, and 1880px on big screens (1600px and wider, so a 1920px monitor with a scrollbar still gets it).
- **No em dashes or en dashes** anywhere. Eyebrows use a small amber ring marker, and the page title separator is a pipe.
- **CTAs:** every button has a solid background.
- **Cards:** service cards are fully clickable.
- **Scroll to top:** it has a progress ring and moves up above the Google reCAPTCHA badge when one is on the page.
- **SEO:** a meta description per page (skipped when Yoast or Rank Math is active), LocalBusiness schema, and FAQPage schema.
- **Motion:** scroll reveal, a process line that draws itself, a brands marquee, spinning drum illustrations, parallax rings and a scroll progress bar. All motion respects `prefers-reduced-motion`.

## Forms

The built-in forms email the recipient set in the Customizer, or the site admin email if none is set. They include a nonce, a honeypot and inline validation. To use a plugin instead (Contact Form 7, Gravity Forms, WPForms), paste its shortcode into **Customizer > Back In Action Settings > Forms**. Developers can hook `bia_form_submitted` to send leads to a CRM.

In the static `docs/` preview the forms only show a "preview" notice.

## Photos

The theme ships with drawn illustrations, so it needs no stock photos. To use real job photos on the About or service pages, set a **featured image** on the page and it replaces the illustration.
