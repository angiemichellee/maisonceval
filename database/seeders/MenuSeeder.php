<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Insert the shop's 20 real products into the menus table.
     * Run after CatalogSeeder and CategorySeeder (see DatabaseSeeder).
     *
     *   php artisan db:seed --class=MenuSeeder
     */




    public function run(): void{
        $everyday = Catalog::all()->firstWhere('slug', 'everyday'); // cari catalog everyday pae slug trs simpen semua row di variable
        $christmas = Catalog::all()->firstWhere('slug', 'christmas');

        $cheesecakes = Category::all()->firstWhere('slug', 'cheesecakes');
        $tarts = Category::all()->firstWhere('slug', 'tarts');
        $littleTreats = Category::all()->firstWhere('slug', 'little-treats');

        $christmasExtras = 'Merry Christmas topper, greeting card & ribbon'; // biar gampang aja



        // ===================== Everyday Menu =====================
        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Iceberg Cheesecake',
            'slug' => 'iceberg-cheesecake',
            'price' => 205000,
            'description' => 'Our creamy burnt cheesecake meets a thick layer of rich chocolate, finished with a dusting of cocoa.',
            'image' => 'images/products/iceberg-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Matcha Cheesecake',
            'slug' => 'matcha-cheesecake',
            'price' => 200000,
            'description' => 'Burnt cheesecake layered with a smooth matcha ganache.',
            'image' => 'images/products/matcha-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Brownies Cheesecake',
            'slug' => 'brownies-cheesecake',
            'price' => 195000,
            'description' => 'A fudgy brownie base layered with creamy cheesecake, topped with whipped cream and cocoa.',
            'image' => 'images/products/brownies-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Chocolate Cheesecake',
            'slug' => 'chocolate-cheesecake',
            'price' => 175000,
            'description' => 'Cheesecake with chocolate chunks baked inside, topped with Callebaut chocolate ganache and almonds.',
            'image' => 'images/products/chocolate-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Burnt Cheesecake Original',
            'slug' => 'burnt-cheesecake-original',
            'price' => 165000,
            'description' => 'Pure cream cheese, baked until the top caramelises and the centre stays soft and creamy.',
            'image' => 'images/products/burnt-cheesecake-original.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $tarts->id,
            'name' => 'Lemon Pie Tart',
            'slug' => 'lemon-pie-tart',
            'price' => 165000,
            'description' => 'Buttery pie crust, lemon custard, cream cheese and whipped cream, finished with a lemon glaze.',
            'image' => 'images/products/lemon-pie-tart.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $tarts->id,
            'name' => 'Chocolate Pie Tart',
            'slug' => 'chocolate-pie-tart',
            'price' => 168000,
            'description' => 'Pie crust with a chocolate filling and cheese cream, topped with almonds and chocolate ganache.',
            'image' => 'images/products/chocolate-pie-tart.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $tarts->id,
            'name' => 'Matcha Pie Tart',
            'slug' => 'matcha-pie-tart',
            'price' => 160000,
            'description' => 'Pie crust with a matcha filling, cheese cream and whipped cream, dusted with matcha powder.',
            'image' => 'images/products/matcha-pie-tart.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $littleTreats->id,
            'name' => 'Dubai Kunafa Cheesecake',
            'slug' => 'dubai-kunafa-cheesecake',
            'price' => 55000,
            'description' => 'Cheesecake topped with pistachio kunafa and wrapped in marshmallow.',
            'image' => 'images/products/dubai-kunafa-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $littleTreats->id,
            'name' => 'Chizu',
            'slug' => 'chizu',
            'price' => 38000,
            'description' => 'Our layered cheese dessert in a box, available in three flavours.',
            'image' => 'images/products/chizu.jpg',
            'variants' => json_encode([
                ['name' => 'Tiramisu', 'price' => 38000],
                ['name' => 'Chocolate Callebaut', 'price' => 42000],
                ['name' => 'Kunafa Pistachio', 'price' => 45000],
            ]),
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $littleTreats->id,
            'name' => 'Bucket Brownies Cheesecake',
            'slug' => 'bucket-brownies-cheesecake',
            'price' => 32000,
            'description' => 'Fudgy brownies and cheesecake layers in a 12 oz bucket.',
            'image' => 'images/products/bucket-brownies-cheesecake.jpg',
        ]);

        Menu::create([
            'catalog_id' => $everyday->id,
            'category_id' => $littleTreats->id,
            'name' => 'Dubai Chewy Cookie',
            'slug' => 'dubai-chewy-cookie',
            'price' => 30000,
            'description' => 'A chewy cookie with a pistachio kunafa filling.',
            'image' => 'images/products/dubai-chewy-cookie.jpg',
            'variants' => json_encode([
                ['name' => 'Original (cocoa)'],
                ['name' => 'Vanilla (Dancow)'],
            ]),
        ]);





        // ===================== Christmas Collection =====================
        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Christmas Iceberg Cheesecake',
            'slug' => 'christmas-iceberg-cheesecake',
            'price' => 205000,
            'description' => 'Creamy burnt cheesecake under a thick layer of rich chocolate, dressed for the holidays.',
            'image' => 'images/products/xmas-iceberg-cheesecake.jpg',
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Christmas Matcha Cheesecake',
            'slug' => 'christmas-matcha-cheesecake',
            'price' => 200000,
            'description' => 'Burnt cheesecake layered with matcha ganache, dressed for the holidays.',
            'image' => 'images/products/xmas-matcha-cheesecake.jpg',
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Christmas Brownies Cheesecake',
            'slug' => 'christmas-brownies-cheesecake',
            'price' => 195000,
            'description' => 'Fudgy brownie base and creamy cheesecake, dressed for the holidays.',
            'image' => 'images/products/xmas-brownies-cheesecake.jpg',
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Christmas Chocolate Cheesecake',
            'slug' => 'christmas-chocolate-cheesecake',
            'price' => 175000,
            'description' => 'Chocolate-chunk cheesecake with Callebaut ganache, decorated with festive sprinkles.',
            'image' => 'images/products/xmas-chocolate-cheesecake.jpg',
            'includes' => 'Merry Christmas topper & greeting card',
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $cheesecakes->id,
            'name' => 'Christmas Burnt Cheesecake',
            'slug' => 'christmas-burnt-cheesecake',
            'price' => 165000,
            'description' => 'Our original burnt cheesecake, dressed for the holidays.',
            'image' => 'images/products/xmas-burnt-cheesecake.jpg',
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $littleTreats->id,
            'name' => 'Chizu Box of 1',
            'slug' => 'christmas-chizu-box-of-1',
            'price' => 45000,
            'description' => 'One Chizu box in the flavour of your choice, wrapped as a gift.',
            'image' => 'images/products/xmas-box-of-1.jpg',
            'variants' => json_encode([
                ['name' => 'Tiramisu'],
                ['name' => 'Chocolate Callebaut'],
                ['name' => 'Kunafa Pistachio'],
            ]),
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $littleTreats->id,
            'name' => 'Brownies Cup of 1',
            'slug' => 'christmas-brownies-cup-of-1',
            'price' => 35000,
            'description' => 'One bucket of brownies in the flavour of your choice, wrapped as a gift.',
            'image' => 'images/products/xmas-cup-of-1.jpg',
            'variants' => json_encode([
                ['name' => 'Original'],
                ['name' => 'Cheesecake'],
            ]),
            'includes' => $christmasExtras,
        ]);

        Menu::create([
            'catalog_id' => $christmas->id,
            'category_id' => $littleTreats->id,
            'name' => 'Cup of 2',
            'slug' => 'christmas-cup-of-2',
            'price' => 71500,
            'description' => 'A pair of cups: brownies (Original or Cheesecake) together with Chizu (Tiramisu, Chocolate Callebaut or Kunafa Pistachio).',
            'image' => 'images/products/xmas-cup-of-2.jpg',
            'includes' => $christmasExtras,
        ]);
    }
}
