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

    public const CATALOG_GENERAL = 'general';

    public const CATALOG_CHRISTMAS = 'christmas';

    protected $fillable = [
        'category_id', 'name', 'slug', 'catalog', 'price', 'description',
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

    public function scopeGeneral(Builder $query): Builder
    {
        return $query->where('catalog', self::CATALOG_GENERAL);
    }

    public function scopeChristmas(Builder $query): Builder
    {
        return $query->where('catalog', self::CATALOG_CHRISTMAS);
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

    protected function isChristmas(): Attribute
    {
        return Attribute::get(fn () => $this->catalog === self::CATALOG_CHRISTMAS);
    }

    protected function catalogLabel(): Attribute
    {
        return Attribute::get(fn () => $this->is_christmas ? 'Christmas Collection' : 'Everyday Menu');
    }
}
