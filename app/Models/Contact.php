<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = ['instagram', 'email', 'phoneNumber', 'whatsapp', 'address', 'opening_hours'];



    public static function current() {
        $contact = Contact::all()->first(); // ambil kontak paling pertama

        if ($contact == null) {
            $contact = new Contact(['instagram' => 'maisonceval', 'email' => 'hello@maisonceval.com']); // pake ini kl null
        }

        return $contact;
    }





    public function instagramUrl(){
        return 'https://www.instagram.com/maisonceval';
    }



    /** WhatsApp number in international format: 0812 3456 7890 -> 6281234567890 */
    public function whatsappNumber() {
        $number = preg_replace('/[^0-9]/', '', (string) $this->whatsapp); //remove semua yg bukan angka

        if (str_starts_with($number, '0')) { // karakter pertama hrs 0
            $number = '62' . substr($number, 1); // 0 diganti 62
        }

        return $number;
    }




    public function orderUrl($message = 'Hello Maison Céval, I would like to place an order.') {
        if ($this->whatsappNumber() != '') {
            return 'https://api.whatsapp.com/send/?phone=6285190071733&text&type=phone_number&app_absent=0';
        }

        return 'https://www.instagram.com/maisonceval';
    }




    public function orderChannel() {
        if ($this->whatsappNumber() != '') {
            return 'WhatsApp';
        }

        return 'Instagram';
    }
}
