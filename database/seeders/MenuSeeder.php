<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Seeds the shop's real products. Each product names its catalog by slug
     * ('catalog' => 'christmas'); without one it goes in the Everyday Menu.
     * Photos live in public/images/products. Safe to run again: rows are
     * matched by slug and updated instead of duplicated.
     */
    public function run(): void
    {
        $category = Category::pluck('id', 'slug');
        $catalog = Catalog::pluck('id', 'slug');

        $christmasExtras = 'Merry Christmas topper, greeting card & ribbon';

        $menus = [
            /* ---------------- Everyday menu (general catalog) ---------------- */
            [
                'name' => 'Iceberg Cheesecake',
                'slug' => 'iceberg-cheesecake',
                'category' => 'cheesecakes',
                'price' => 205000,
                'description' => 'Our creamy burnt cheesecake meets a thick layer of rich chocolate, finished with a dusting of cocoa.',
                'image' => 'images/products/iceberg-cheesecake.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Matcha Cheesecake',
                'slug' => 'matcha-cheesecake',
                'category' => 'cheesecakes',
                'price' => 200000,
                'description' => 'Burnt cheesecake layered with a smooth matcha ganache.',
                'image' => 'images/products/matcha-cheesecake.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Brownies Cheesecake',
                'slug' => 'brownies-cheesecake',
                'category' => 'cheesecakes',
                'price' => 195000,
                'description' => 'A fudgy brownie base layered with creamy cheesecake, topped with whipped cream and cocoa.',
                'image' => 'images/products/brownies-cheesecake.jpg',
            ],
            [
                'name' => 'Chocolate Cheesecake',
                'slug' => 'chocolate-cheesecake',
                'category' => 'cheesecakes',
                'price' => 175000,
                'description' => 'Cheesecake with chocolate chunks baked inside, topped with Callebaut chocolate ganache and almonds.',
                'image' => 'images/products/chocolate-cheesecake.jpg',
            ],
            [
                'name' => 'Burnt Cheesecake Original',
                'slug' => 'burnt-cheesecake-original',
                'category' => 'cheesecakes',
                'price' => 165000,
                'description' => 'Pure cream cheese, baked until the top caramelises and the centre stays soft and creamy.',
                'image' => 'images/products/burnt-cheesecake-original.jpg',
            ],
            [
                'name' => 'Lemon Pie Tart',
                'slug' => 'lemon-pie-tart',
                'category' => 'tarts',
                'price' => 165000,
                'description' => 'Buttery pie crust, lemon custard, cream cheese and whipped cream, finished with a lemon glaze.',
                'image' => 'images/products/lemon-pie-tart.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Chocolate Pie Tart',
                'slug' => 'chocolate-pie-tart',
                'category' => 'tarts',
                'price' => 168000,
                'description' => 'Pie crust with a chocolate filling and cheese cream, topped with almonds and chocolate ganache.',
                'image' => 'images/products/chocolate-pie-tart.jpg',
            ],
            [
                'name' => 'Matcha Pie Tart',
                'slug' => 'matcha-pie-tart',
                'category' => 'tarts',
                'price' => 160000,
                'description' => 'Pie crust with a matcha filling, cheese cream and whipped cream, dusted with matcha powder.',
                'image' => 'images/products/matcha-pie-tart.jpg',
            ],
            [
                'name' => 'Dubai Kunafa Cheesecake',
                'slug' => 'dubai-kunafa-cheesecake',
                'category' => 'little-treats',
                'price' => 55000,
                'description' => 'Cheesecake topped with pistachio kunafa and wrapped in marshmallow.',
                'image' => 'images/products/dubai-kunafa-cheesecake.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Chizu',
                'slug' => 'chizu',
                'category' => 'little-treats',
                'price' => 38000,
                'description' => 'Our layered cheese dessert in a box, available in three flavours.',
                'image' => 'images/products/chizu.jpg',
                'variants' => [
                    ['name' => 'Tiramisu', 'price' => 38000],
                    ['name' => 'Chocolate Callebaut', 'price' => 42000],
                    ['name' => 'Kunafa Pistachio', 'price' => 45000],
                ],
            ],
            [
                'name' => 'Bucket Brownies Cheesecake',
                'slug' => 'bucket-brownies-cheesecake',
                'category' => 'little-treats',
                'price' => 32000,
                'description' => 'Fudgy brownies and cheesecake layers in a 12 oz bucket.',
                'image' => 'images/products/bucket-brownies-cheesecake.jpg',
            ],
            [
                'name' => 'Dubai Chewy Cookie',
                'slug' => 'dubai-chewy-cookie',
                'category' => 'little-treats',
                'price' => 30000,
                'description' => 'A chewy cookie with a pistachio kunafa filling.',
                'image' => 'images/products/dubai-chewy-cookie.jpg',
                'variants' => [
                    ['name' => 'Original (cocoa)'],
                    ['name' => 'Vanilla (Dancow)'],
                ],
            ],

            /* ---------------- Christmas catalog ---------------- */
            [
                'name' => 'Christmas Iceberg Cheesecake',
                'slug' => 'christmas-iceberg-cheesecake',
                'catalog' => 'christmas',
                'category' => 'cheesecakes',
                'price' => 205000,
                'description' => 'Creamy burnt cheesecake under a thick layer of rich chocolate, dressed for the holidays.',
                'image' => 'images/products/xmas-iceberg-cheesecake.jpg',
                'includes' => $christmasExtras,
                'is_featured' => true,
            ],
            [
                'name' => 'Christmas Matcha Cheesecake',
                'slug' => 'christmas-matcha-cheesecake',
                'catalog' => 'christmas',
                'category' => 'cheesecakes',
                'price' => 200000,
                'description' => 'Burnt cheesecake layered with matcha ganache, dressed for the holidays.',
                'image' => 'images/products/xmas-matcha-cheesecake.jpg',
                'includes' => $christmasExtras,
                'is_featured' => true,
            ],
            [
                'name' => 'Christmas Brownies Cheesecake',
                'slug' => 'christmas-brownies-cheesecake',
                'catalog' => 'christmas',
                'category' => 'cheesecakes',
                'price' => 195000,
                'description' => 'Fudgy brownie base and creamy cheesecake, dressed for the holidays.',
                'image' => 'images/products/xmas-brownies-cheesecake.jpg',
                'includes' => $christmasExtras,
            ],
            [
                'name' => 'Christmas Chocolate Cheesecake',
                'slug' => 'christmas-chocolate-cheesecake',
                'catalog' => 'christmas',
                'category' => 'cheesecakes',
                'price' => 175000,
                'description' => 'Chocolate-chunk cheesecake with Callebaut ganache, decorated with festive sprinkles.',
                'image' => 'images/products/xmas-chocolate-cheesecake.jpg',
                'includes' => 'Merry Christmas topper & greeting card',
            ],
            [
                'name' => 'Christmas Burnt Cheesecake',
                'slug' => 'christmas-burnt-cheesecake',
                'catalog' => 'christmas',
                'category' => 'cheesecakes',
                'price' => 165000,
                'description' => 'Our original burnt cheesecake, dressed for the holidays.',
                'image' => 'images/products/xmas-burnt-cheesecake.jpg',
                'includes' => $christmasExtras,
                'is_featured' => true,
            ],
            [
                'name' => 'Chizu Box of 1',
                'slug' => 'christmas-chizu-box-of-1',
                'catalog' => 'christmas',
                'category' => 'little-treats',
                'price' => 45000,
                'description' => 'One Chizu box in the flavour of your choice, wrapped as a gift.',
                'image' => 'images/products/xmas-box-of-1.jpg',
                'includes' => $christmasExtras,
                'variants' => [
                    ['name' => 'Tiramisu'],
                    ['name' => 'Chocolate Callebaut'],
                    ['name' => 'Kunafa Pistachio'],
                ],
                'is_featured' => true,
            ],
            [
                'name' => 'Brownies Cup of 1',
                'slug' => 'christmas-brownies-cup-of-1',
                'catalog' => 'christmas',
                'category' => 'little-treats',
                'price' => 35000,
                'description' => 'One bucket of brownies in the flavour of your choice, wrapped as a gift.',
                'image' => 'images/products/xmas-cup-of-1.jpg',
                'includes' => $christmasExtras,
                'variants' => [
                    ['name' => 'Original'],
                    ['name' => 'Cheesecake'],
                ],
            ],
            [
                'name' => 'Cup of 2',
                'slug' => 'christmas-cup-of-2',
                'catalog' => 'christmas',
                'category' => 'little-treats',
                'price' => 71500,
                'description' => 'A pair of cups: brownies (Original or Cheesecake) together with Chizu (Tiramisu, Chocolate Callebaut or Kunafa Pistachio).',
                'image' => 'images/products/xmas-cup-of-2.jpg',
                'includes' => $christmasExtras,
            ],
        ];

        foreach ($menus as $index => $menu) {
            $categorySlug = $menu['category'];
            $catalogSlug = $menu['catalog'] ?? 'everyday';
            unset($menu['category'], $menu['catalog']);

            Menu::updateOrCreate(
                ['slug' => $menu['slug']],
                $menu + [
                    'category_id' => $category[$categorySlug] ?? null,
                    'catalog_id' => $catalog[$catalogSlug] ?? null,
                    'variants' => null,
                    'includes' => null,
                    'is_featured' => false,
                    'is_available' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
