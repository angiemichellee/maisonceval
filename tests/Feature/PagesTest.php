<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_main_pages_load(): void
    {
        foreach (['/', '/menu', '/menu?category=tarts', '/christmas', '/category', '/contact'] as $url) {
            $this->get($url)->assertOk()->assertSee('Maison Céval', false);
        }
    }

    public function test_menu_shows_general_catalog_only(): void
    {
        $this->get('/menu')
            ->assertSee('Lemon Pie Tart')
            ->assertSee('Rp 165.000')
            ->assertDontSee('Christmas Iceberg Cheesecake');
    }

    public function test_christmas_page_shows_christmas_catalog(): void
    {
        $this->get('/christmas')
            ->assertSee('Christmas Matcha Cheesecake')
            ->assertSee('Cup of')
            ->assertDontSee('Lemon Pie Tart');
    }

    public function test_every_product_has_a_page(): void
    {
        Menu::all()->each(fn (Menu $menu) => $this->get(route('menu.show', $menu))->assertOk()->assertSee($menu->price_label));
    }

    public function test_unknown_product_returns_404(): void
    {
        $this->get('/menu/does-not-exist')->assertNotFound();
    }

    public function test_order_button_uses_whatsapp_when_a_number_is_set(): void
    {
        $this->get('/contact')->assertSee('https://ig.me/m/maisonceval', false);

        Contact::first()->update(['whatsapp' => '0812 3456 7890']);

        $this->get('/contact')->assertSee('https://wa.me/6281234567890', false);
    }
}
