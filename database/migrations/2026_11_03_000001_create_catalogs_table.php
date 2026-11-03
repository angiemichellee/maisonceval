<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Catalogs become their own table (Everyday Menu, Christmas Collection,
 * and later Halloween, Lebaran, Valentine...). Each product belongs to one
 * catalog through menus.catalog_id.
 *
 * Existing products keep their catalog: the old text column
 * menus.catalog ('general' / 'christmas') is converted, then removed.
 */
return new class extends Migration
{
    /** How the old text values map to the new catalog rows. */
    private array $legacy = [
        'general' => ['name' => 'Everyday Menu', 'slug' => 'everyday', 'color' => '#64501B', 'is_seasonal' => false, 'sort_order' => 1],
        'christmas' => ['name' => 'Christmas Collection', 'slug' => 'christmas', 'color' => '#6B1C1A', 'is_seasonal' => true, 'sort_order' => 2],
    ];

    public function up(): void
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            // Accent colour used for the catalog's banner and cards, e.g. #6B1C1A
            $table->string('color', 7)->default('#64501B');
            // Seasonal catalogs (Christmas, Halloween...) get a badge on product cards
            $table->boolean('is_seasonal')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('catalog_id')->nullable()->after('category_id')
                ->constrained()->nullOnDelete();
        });

        // Move existing products over to the new catalogs.
        if (Schema::hasColumn('menus', 'catalog')) {
            $now = now();

            foreach (DB::table('menus')->distinct()->pluck('catalog')->filter() as $old) {
                $data = $this->legacy[$old] ?? [
                    'name' => ucfirst($old), 'slug' => $old, 'color' => '#64501B',
                    'is_seasonal' => true, 'sort_order' => 99,
                ];

                $id = DB::table('catalogs')->insertGetId($data + ['created_at' => $now, 'updated_at' => $now]);

                DB::table('menus')->where('catalog', $old)->update(['catalog_id' => $id]);
            }

            Schema::table('menus', function (Blueprint $table) {
                $table->dropIndex(['catalog']);
            });
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('catalog');
            });
        }
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('catalog')->default('general')->after('slug')->index();
        });

        foreach (DB::table('catalogs')->get() as $catalog) {
            $old = array_search($catalog->slug, array_column($this->legacy, 'slug', null), true);
            $old = $old !== false ? array_keys($this->legacy)[$old] : $catalog->slug;

            DB::table('menus')->where('catalog_id', $catalog->id)->update(['catalog' => $old]);
        }

        Schema::table('menus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('catalog_id');
        });

        Schema::dropIfExists('catalogs');
    }
};
