<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Insert the shop's contact details into the contacts table.
     * TODO: replace with the real details before going live.
     * When a WhatsApp number is filled in, every "Order" button opens WhatsApp.
     *
     *   php artisan db:seed --class=ContactSeeder
     */
    public function run(): void
    {
        Contact::create([
            'instagram' => 'maisonceval',
            'email' => 'hello@maisonceval.com',
            'phoneNumber' => null,     // e.g. '0812 3456 7890'
            'whatsapp' => null,        // e.g. '0812 3456 7890'
            'address' => null,         // e.g. 'Jl. ..., Jakarta'
            'opening_hours' => null,   // e.g. 'Mon–Sat, 09.00–18.00'
        ]);
    }
}
