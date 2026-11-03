<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A catalog groups products, e.g. "Everyday Menu", "Christmas Collection".
 * Add a new one (Halloween, Lebaran...) by adding a row: the home page,
 * catalog pages and menu pick it up automatically.
 */
class Catalog extends Model
{
    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'image', 'color',
        'is_seasonal', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_seasonal' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /** Cover photo: the catalog's own image, or its first product's photo. */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            if ($this->image) {
                return str_starts_with($this->image, 'http') ? $this->image : asset($this->image);
            }

            $first = $this->relationLoaded('menus')
                ? $this->menus->first()
                : $this->menus()->available()->ordered()->first();

            return $first?->image_url ?? asset('images/logo-mark.png');
        });
    }

    /** Accent colour, always a safe #RRGGBB value for use in inline CSS. */
    protected function accent(): Attribute
    {
        return Attribute::get(fn () => preg_match('/^#[0-9A-Fa-f]{6}$/', (string) $this->color) ? $this->color : '#64501B');
    }
}
