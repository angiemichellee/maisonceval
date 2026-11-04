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

    // kayak allData tp panggil yg active aja
    public static function activeData() {
        return Catalog::all()->where('is_active', 1); // semua row dibuat jd collection, lalu kl is_active 1 jd collection
    }

    // menghitung menu
    public function countMenus(){
        return Menu::visible()->where('catalog_id', $this->id)->count(); // cek dulu di catalog id apa, di count buat muculin di card
    }
}
