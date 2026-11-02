<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * TODO: replace these with the shop's real details before going live.
     * As soon as a WhatsApp number is filled in, every "Order" button on the
     * site opens WhatsApp with a ready-made message. Until then they open an
     * Instagram direct message.
     */
    public function run(): void
    {
        $contact = Contact::query()->firstOrNew();

        $contact->fill([
            'instagram' => 'maisonceval',
            'email' => 'hello@maisonceval.com',
            'phoneNumber' => null,   // e.g. '0812 3456 7890'
            'whatsapp' => null,      // e.g. '0812 3456 7890'
            'address' => null,       // e.g. 'Jl. ..., Jakarta'
            'opening_hours' => null, // e.g. 'Mon–Sat, 09.00–18.00'
        ])->save();
    }
}
