# Maison Céval: website

Company-profile website for **Maison Céval**, a cake shop (since 2020).
Pure Taste. Pure Class. Live at https://maisonceval.my.id

Built with Laravel. Every catalog, product, category and contact detail is stored
in the database, so an admin panel can be added later without changing the pages.

## Pages

| URL | What it shows |
| --- | --- |
| `/` | Home: hero, catalogs, find your favourite, how to order |
| `/catalog` | All active catalogs |
| `/catalog/{slug}` | One catalog and its products, e.g. `/catalog/christmas` |
| `/menu` | Every product, grouped by catalog. Filter with `?category=cheesecakes`, `tarts`, `little-treats` |
| `/menu/{slug}` | Product detail with flavours and an order button |
| `/contact` | Contact channels and how to order |

Old addresses `/christmas` and `/category` redirect to the catalog pages.

## Run it

```sh
php artisan migrate      # creates/updates the tables
php artisan db:seed      # loads catalogs, categories and the 20 products (safe to run again)
php artisan serve
```

On the live server add `--force` to both commands.
Run the tests with `php artisan test`.

## Adding a catalog (e.g. Halloween)

1. In `database/seeders/CatalogSeeder.php`, add an entry (there is a commented
   Halloween example): name, slug, tagline, cover image, colour, `is_seasonal`.
2. In `database/seeders/MenuSeeder.php`, add its products with `'catalog' => 'halloween'`.
3. Put the photos in `public/images/products/` and run `php artisan db:seed`.

The new catalog then appears on the home page, the catalog page and the menu,
with its own colour. Set `is_active` to false to hide a catalog after the season.

## Where things live

- **Catalogs:** `catalogs` table, `database/seeders/CatalogSeeder.php`
- **Products and prices:** `menus` table, `database/seeders/MenuSeeder.php`
- **Contact details:** `database/seeders/ContactSeeder.php`. When a WhatsApp number
  is filled in, every "Order" button opens WhatsApp with a ready-made message.
  Without one, the buttons open an Instagram direct message.
- **Photos:** `public/images/products/`
- **Logo files:** `public/images/` (`logo.png`, `logo-mark.png`, `logo-wordmark.png`, plus `-light` versions for dark backgrounds)
- **Styles:** `public/css/maison.css` (plain CSS, no build step). The background `#FAF8F2` matches the logo.
- **Pages:** `resources/views/` (`layouts/app.blade.php` holds the shared header and footer;
  `components/product-card.blade.php` and `components/catalog-card.blade.php` are the cards)

## Database fields (for a future admin panel)

- `catalogs`: `name`, `slug`, `tagline`, `description`, `image`, `color`, `is_seasonal`, `is_active`, `sort_order`
- `menus`: `catalog_id`, `category_id`, `name`, `slug`, `price`, `description`, `image`,
  `variants` (JSON flavour list), `includes`, `is_featured`, `is_available`, `sort_order`
- `categories`: `name`, `slug`, `description`, `sort_order`
