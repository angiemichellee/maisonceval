<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\HtmlString;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id', 'catalog_id', 'name', 'slug', 'price', 'description',
        'image', 'variants', 'includes', 'is_featured', 'is_available', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'variants' => 'array',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* ---------------------------------------------------------------
     | Query scopes
     * -------------------------------------------------------------- */

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_available', true);
    }

    /** Only products in active catalogs (or with no catalog). */
    public function scopeInActiveCatalog(Builder $query): Builder
    {
        return $query->where(fn ($q) => $q->whereNull('catalog_id')
            ->orWhereHas('catalog', fn ($c) => $c->where('is_active', true)));
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /* ---------------------------------------------------------------
     | Helpers used by the views
     * -------------------------------------------------------------- */

    public static function rupiah(int|float|null $amount): string
    {
        return 'Rp '.number_format((float) $amount, 0, ',', '.');
    }

    /** "Rp 165.000", or "From Rp 38.000" when flavours have different prices. */
    protected function priceLabel(): Attribute
    {
        return Attribute::get(function () {
            $prices = collect($this->variants ?? [])->pluck('price')->filter()->unique();

            return $prices->count() > 1
                ? 'From '.self::rupiah($prices->min())
                : self::rupiah($this->price);
        });
    }

    /** Name for headings, with numbers set in the body font for legibility. */
    protected function displayName(): Attribute
    {
        return Attribute::get(fn () => new HtmlString(
            preg_replace('/\d+/', '<span class="num">$0</span>', e($this->name))
        ));
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->image) {
                return asset('images/logo-mark.png');
            }

            return str_starts_with($this->image, 'http')
                ? $this->image
                : asset($this->image);
        });
    }

    /** True for products in a seasonal catalog (Christmas, Halloween...). */
    protected function isSeasonal(): Attribute
    {
        return Attribute::get(fn () => (bool) $this->catalog?->is_seasonal);
    }

    /** Accent colour of the product's catalog. */
    protected function accent(): Attribute
    {
        return Attribute::get(fn () => $this->catalog?->accent ?? '#64501B');
    }
}
