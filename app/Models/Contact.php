<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = ['instagram', 'email', 'phoneNumber', 'whatsapp', 'address', 'opening_hours'];

    /**
     * The shop's contact details (the first row of the contacts table).
     * If the table is still empty, return default details so the page still works.
     */
    public static function current()
    {
        $contact = Contact::all()->first();

        if ($contact == null) {
            $contact = new Contact(['instagram' => 'maisonceval', 'email' => 'hello@maisonceval.com']);
        }

        return $contact;
    }

    public function instagramUrl()
    {
        return 'https://instagram.com/' . $this->instagram;
    }

    /** WhatsApp number in international format: 0812 3456 7890 -> 6281234567890 */
    public function whatsappNumber()
    {
        $number = preg_replace('/[^0-9]/', '', (string) $this->whatsapp);

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }

    /**
     * Where the "Order via ..." buttons go:
     * WhatsApp (with a ready-made message) when a number is filled in,
     * otherwise an Instagram direct message.
     */
    public function orderUrl($message = 'Hello Maison Céval, I would like to place an order.')
    {
        if ($this->whatsappNumber() != '') {
            return 'https://wa.me/' . $this->whatsappNumber() . '?text=' . rawurlencode($message);
        }

        return 'https://ig.me/m/' . $this->instagram;
    }

    public function orderChannel()
    {
        if ($this->whatsappNumber() != '') {
            return 'WhatsApp';
        }

        return 'Instagram';
    }
}
