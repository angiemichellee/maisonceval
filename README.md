# Maison Céval: website

Company-profile website for **Maison Céval**, a cake shop (since 2020).
Pure Taste. Pure Class. Live at https://maisonceval.my.id

Built with Laravel using the MVC structure: **Routes** (`routes/web.php`) →
**Controllers** (`app/Http/Controllers`) → **Models** (`app/Models`) → **Views** (`resources/views`).
All products, catalogs, categories and contact details come from the database.

## Pages (routes/web.php)

| URL | Controller | View |
| --- | --- | --- |
| `/` | `HomeController@index` | `home.blade.php` |
| `/catalog/{slug}` e.g. `/catalog/christmas` | `CatalogController@show` | `catalog.blade.php` |
| `/menu` | `MenuController@index` | `menu.blade.php` |
| `/menu/category/{slug}` e.g. `/menu/category/tarts` | `MenuController@category` | `menu.blade.php` |
| `/menu/{slug}` e.g. `/menu/lemon-pie-tart` | `MenuController@show` | `showmenu.blade.php` |

The layout is `resources/views/layout/mainlayout.blade.php`. It includes
`layout/navigation`, `layout/ordering` (How to order) and `layout/footer`.
Product and catalog cards are `layout/productcard` and `layout/catalogcard`.

## Database

| Table | Model | Migration | Seeder | Factory |
| --- | --- | --- | --- | --- |
| catalogs | `Catalog` | `create_catalogs_table` | `CatalogSeeder` | `CatalogFactory` |
| categories | `Category` | `create_categories_table` | `CategorySeeder` | `CategoryFactory` |
| menus | `Menu` | `create_menus_table` | `MenuSeeder` | `MenuFactory` |
| contacts | `Contact` | `create_contacts_table` | `ContactSeeder` | `ContactFactory` |

`menus.catalog_id` and `menus.category_id` store the id of the product's catalog and category.

## Run it

```sh
php artisan migrate:fresh --seed   # create all tables and insert the data
php artisan serve
```

Run the seeders only once on empty tables (the `slug` columns are unique, so
running `db:seed` twice stops with a "UNIQUE constraint" error).
To start again with fresh data: `php artisan migrate:fresh --seed`.

## Adding a catalog (e.g. Halloween)

1. In `database/seeders/CatalogSeeder.php`, copy a `Catalog::create([...])` block (there is a Halloween example).
2. In `database/seeders/MenuSeeder.php`, add its products with `'catalog_id' => $halloween->id`.
3. Put the photos in `public/images/products/` and run `php artisan migrate:fresh --seed`.

Set `is_active` to `false` to hide a catalog, or `is_available` to `false` to hide one product.

## Other files

- **Photos:** `public/images/products/`, logo files in `public/images/`
- **Styles:** `public/css/maison.css` (after editing, change `?v=` in `mainlayout.blade.php`)
- **Contact details:** `database/seeders/ContactSeeder.php`. When a WhatsApp number
  is filled in, the "Order via ..." buttons open WhatsApp with a ready-made message.
