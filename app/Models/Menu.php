<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'catalog_id', 'category_id', 'name', 'slug', 'price', 'description',
        'image', 'variants', 'includes', 'is_available',
    ];

    /**
     * All products that are shown on the website:
     * the product is available AND its catalog is active.
     */
    public static function visible()
    {
        $catalogs = Catalog::activeData();
        $result = [];

        foreach (Menu::all() as $menu) {
            if ($menu->is_available && $catalogs->firstWhere('id', $menu->catalog_id)) {
                $result[] = $menu;
            }
        }

        return collect($result);
    }

    /** Up to 4 other products from the same catalog (for "You may also like"). */
    public static function related($menu)
    {
        $result = [];

        foreach (Menu::visible()->where('catalog_id', $menu->catalog_id) as $other) {
            if ($other->id != $menu->id && count($result) < 4) {
                $result[] = $other;
            }
        }

        return collect($result);
    }

    /**
     * The flavours as an array, e.g. [['name' => 'Tiramisu', 'price' => 38000], ...].
     * They are saved in the database as JSON text (see MenuSeeder).
     */
    public function variantList()
    {
        if ($this->variants == null) {
            return [];
        }

        return json_decode($this->variants, true);
    }

    /** "Rp 165.000", or "From Rp 38.000" when the flavours have different prices. */
    public function priceLabel()
    {
        $prices = [];

        foreach ($this->variantList() as $variant) {
            if (isset($variant['price'])) {
                $prices[] = $variant['price'];
            }
        }

        if (count(array_unique($prices)) > 1) {
            return 'From Rp ' . number_format(min($prices), 0, ',', '.');
        }

        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
