<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'instagram', 'email', 'phoneNumber', 'whatsapp', 'address', 'opening_hours',
    ];

    /**
     * The shop's contact details (first row of the table).
     * Falls back to an empty model so the pages never crash before seeding.
     */
    public static function current(): self
    {
        return static::query()->first() ?? new static([
            'instagram' => 'maisonceval',
            'email' => 'hello@maisonceval.com',
        ]);
    }

    protected function instagramHandle(): Attribute
    {
        return Attribute::get(fn () => $this->instagram ? ltrim($this->instagram, '@') : null);
    }

    protected function instagramUrl(): Attribute
    {
        return Attribute::get(fn () => $this->instagram_handle
            ? 'https://instagram.com/'.$this->instagram_handle
            : null);
    }

    /** WhatsApp number in international format without "+" (0812... → 62812...). */
    protected function whatsappNumber(): Attribute
    {
        return Attribute::get(function () {
            $digits = preg_replace('/\D+/', '', (string) ($this->whatsapp ?: $this->phoneNumber));

            if ($digits === '') {
                return null;
            }

            return str_starts_with($digits, '0') ? '62'.substr($digits, 1) : $digits;
        });
    }

    /**
     * Where the "Order" buttons point: WhatsApp with a ready-made message when a
     * number is set, otherwise an Instagram direct message.
     */
    public function orderUrl(?string $message = null): ?string
    {
        $message ??= 'Hello Maison Céval, I would like to place an order.';

        if ($this->whatsapp_number) {
            return 'https://wa.me/'.$this->whatsapp_number.'?text='.rawurlencode($message);
        }

        if ($this->instagram_handle) {
            return 'https://ig.me/m/'.$this->instagram_handle;
        }

        return $this->email ? 'mailto:'.$this->email.'?subject='.rawurlencode('Order enquiry') : null;
    }

    public function orderChannel(): string
    {
        return match (true) {
            (bool) $this->whatsapp_number => 'WhatsApp',
            (bool) $this->instagram_handle => 'Instagram',
            default => 'email',
        };
    }
}
