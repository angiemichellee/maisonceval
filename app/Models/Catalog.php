<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    /** @use HasFactory<\Database\Factories\CatalogFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'image', 'color', 'is_seasonal', 'is_active',
    ];

    /**
     * All catalogs that are shown on the website (is_active = 1).
     * Returns a collection, so the controller can use where() / firstWhere().
     */
    public static function activeData()
    {
        return Catalog::all()->where('is_active', 1);
    }

    /** How many products this catalog has on the website. */
    public function countMenus()
    {
        return Menu::visible()->where('catalog_id', $this->id)->count();
    }
}
