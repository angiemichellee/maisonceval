# Maison Céval: website

Company-profile website for **Maison Céval**, a cake shop (since 2020).
Pure Taste. Pure Class.

Built with Laravel. Every product, category and contact detail is stored in the
database, so an admin panel can be added later without changing the pages.

## Pages

| URL | What it shows |
| --- | --- |
| `/` | Home: hero, story, signature bakes, categories, Christmas teaser, how to order |
| `/menu` | Everyday (general) catalog, filter with `?category=cheesecakes`, `tarts`, `little-treats` |
| `/christmas` | Christmas catalog |
| `/menu/{slug}` | Product detail with flavours and an order button |
| `/category` | Both catalogs and all categories |
| `/contact` | Contact channels and how to order |

## Run it

```sh
php artisan migrate      # adds the new catalog columns
php artisan db:seed      # loads the 20 real products (safe to run again)
php artisan serve
```

Then open http://127.0.0.1:8000

Run the tests with `php artisan test`.

## Where things live

- **Products and prices:** `database/seeders/MenuSeeder.php` (later: admin panel)
- **Contact details:** `database/seeders/ContactSeeder.php`. When a WhatsApp number
  is filled in, every "Order" button opens WhatsApp with a ready-made message.
  Without one, the buttons open an Instagram direct message.
- **Photos:** `public/images/products/`
- **Logo files:** `public/images/` (`logo.png`, `logo-mark.png`, `logo-wordmark.png`, plus `-light` versions for dark backgrounds)
- **Styles:** `public/css/maison.css` (plain CSS, no build step). The background `#FAF8F2` matches the logo.
- **Pages:** `resources/views/` (`layouts/app.blade.php` holds the shared header and footer)

## Making it dynamic (next step)

The `menus` table already has everything an admin form needs: `name`, `slug`,
`catalog` (`general` / `christmas`), `category_id`, `price`, `description`, `image`,
`variants` (JSON flavour list), `includes`, `is_featured`, `is_available`, `sort_order`.
Setting `is_available` to false hides a product. `is_featured` puts it on the home page.
