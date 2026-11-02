<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds everything the public website needs to show the real catalog
 * (categories, photos, Christmas vs. general catalog, flavour options...).
 *
 * The columns are chosen so an admin panel can later edit every field
 * without another schema change.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->unsignedInteger('sort_order')->default(0)->after('description');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')
                ->constrained()->nullOnDelete();
            $table->string('slug')->nullable()->unique()->after('name');
            // 'general' or 'christmas' (seasonal catalogs can be added later)
            $table->string('catalog')->default('general')->after('slug')->index();
            $table->string('image')->nullable()->after('description');
            // Flavour / option list: [{"name": "Tiramisu", "price": 38000}, ...]
            $table->json('variants')->nullable()->after('image');
            // e.g. "Merry Christmas topper, greeting card & ribbon"
            $table->string('includes')->nullable()->after('variants');
            $table->boolean('is_featured')->default(false)->after('includes');
            $table->boolean('is_available')->default(true)->after('is_featured');
            $table->unsignedInteger('sort_order')->default(0)->after('is_available');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->text('description')->change();
        });

        Schema::table('contacts', function (Blueprint $table) {
            // Phone numbers need to be text: they start with 0 / +62 and are
            // longer than an integer column allows.
            $table->string('phoneNumber')->nullable()->change();
            $table->string('instagram')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('whatsapp')->nullable()->after('phoneNumber');
            $table->string('address')->nullable()->after('whatsapp');
            $table->string('opening_hours')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['whatsapp', 'address', 'opening_hours']);
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropUnique(['slug']);
            $table->dropIndex(['catalog']);
            $table->dropColumn([
                'slug', 'catalog', 'image', 'variants', 'includes',
                'is_featured', 'is_available', 'sort_order',
            ]);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'description', 'sort_order']);
        });
    }
};
