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



    // yg dimunculin
    public static function visible(){
        $catalogs = Catalog::activeData(); // variabel catalog isinya semua catalog yg active
        $result = []; // buat array untuk isi produknya

        foreach (Menu::all() as $menu) {
            if ($menu->is_available && $catalogs->firstWhere('id', $menu->catalog_id)) { // kl menunya tersedia dan cari lalu memastikan kl katalog itu ada sesuai dgn id yg dicari
                $result[] = $menu; // kl sesuai disimpan ke array
            }
        }

        return collect($result); // ubah array ke laravel collection (object)
    }



    public static function related($menu){
        $result = [];

        foreach (Menu::visible()->where('catalog_id', $menu->catalog_id) as $other) { // ambil menu yg visible di catalog id yg sama 
            if ($other->id != $menu->id && count($result) < 4) { // kl yg di cek beda dgn yg dishow dan cm 4
                $result[] = $other; // masuk ke array
            }
        }

        return collect($result); 
    }




    public function variantList(){
        if ($this->variants == null) { // kl ga ada variant kosong
            return [];
        }

        return json_decode($this->variants, true); 
    }





    public function priceLabel(){ 
        $prices = []; // buat array

        foreach ($this->variantList() as $variant) { 
            if (isset($variant['price'])) {
                $prices[] = $variant['price'];
            }
        }

        if (count(array_unique($prices)) > 1) { // array_unique remove duplicate di setiap produk, >1 supaya beda harga semua
            return 'From Rp ' . number_format(min($prices), 0, ',', '.'); // di format supaya tdk ada angka di blkng koma dan komanya, pake titik
        }

        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
