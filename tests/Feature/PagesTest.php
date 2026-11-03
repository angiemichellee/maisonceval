<?php

namespace Tests\Feature;

use App\Models\Catalog;
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
        foreach (['/', '/catalog/everyday', '/catalog/christmas', '/menu', '/menu?category=tarts', '/menu/lemon-pie-tart'] as $url) {
            $this->get($url)->assertOk()->assertSee('Maison Céval', false);
        }
    }

    public function test_navbar_has_home_catalog_menu_and_order_now(): void
    {
        $this->get('/menu')
            ->assertSeeInOrder(['Home', 'Catalog', 'Menu', 'Order now'])
            ->assertSee('href="http://localhost/#catalogs"', false)
            ->assertSee('href="#ordering"', false)
            ->assertSee('id="ordering"', false);
    }

    public function test_every_page_has_the_ordering_section_and_footer_contact(): void
    {
        foreach (['/', '/catalog/christmas', '/menu', '/menu/lemon-pie-tart'] as $url) {
            $this->get($url)
                ->assertSee('id="ordering"', false)
                ->assertSee('id="contact"', false)
                ->assertSee('hello@maisonceval.com');
        }
    }

    public function test_hero_has_no_explore_catalogs_button(): void
    {
        $this->get('/')->assertDontSee('Explore our catalogs')->assertSee('id="catalogs"', false);
    }

    public function test_home_shows_catalogs_from_the_database(): void
    {
        $this->get('/')
            ->assertSee('Everyday Menu')
            ->assertSee('Christmas Collection')
            ->assertSee('Find your favourite')
            ->assertSee('How to order');
    }

    public function test_a_new_catalog_appears_without_code_changes(): void
    {
        $halloween = Catalog::create(['name' => 'Halloween Collection', 'slug' => 'halloween', 'is_seasonal' => true, 'sort_order' => 3]);
        Menu::first()->replicate()->fill(['slug' => 'pumpkin-test', 'name' => 'Pumpkin Test Cake', 'catalog_id' => $halloween->id])->save();

        $this->get('/')->assertSee('Halloween Collection');
        $this->get('/catalog/halloween')->assertOk()->assertSee('Pumpkin Test Cake');
        $this->get('/menu')->assertSee('Pumpkin Test Cake');
    }

    public function test_inactive_catalog_is_hidden(): void
    {
        Catalog::where('slug', 'christmas')->update(['is_active' => false]);

        $this->get('/catalog/christmas')->assertNotFound();
        $this->get('/menu')->assertDontSee('Christmas Matcha Cheesecake');
        $this->get('/menu/christmas-matcha-cheesecake')->assertNotFound();
    }

    public function test_catalog_page_shows_only_its_products(): void
    {
        $this->get('/catalog/christmas')
            ->assertSee('Christmas Matcha Cheesecake')
            ->assertDontSee('Lemon Pie Tart');
    }

    public function test_menu_shows_every_product_with_price(): void
    {
        $response = $this->get('/menu');

        Menu::all()->each(fn (Menu $menu) => $response->assertSee($menu->price_label));
    }

    public function test_every_product_has_a_page(): void
    {
        Menu::all()->each(fn (Menu $menu) => $this->get(route('menu.show', $menu))->assertOk()->assertSee($menu->price_label));
    }

    public function test_old_addresses_redirect(): void
    {
        $this->get('/christmas')->assertRedirect('/catalog/christmas');
        $this->get('/catalog')->assertRedirect('/#catalogs');
        $this->get('/category')->assertRedirect('/#catalogs');
        $this->get('/contact')->assertRedirect('/#contact');
    }

    public function test_unknown_pages_return_404(): void
    {
        $this->get('/menu/does-not-exist')->assertNotFound();
        $this->get('/catalog/does-not-exist')->assertNotFound();
    }

    public function test_order_button_uses_whatsapp_when_a_number_is_set(): void
    {
        $this->get('/')->assertSee('https://ig.me/m/maisonceval', false);

        Contact::first()->update(['whatsapp' => '0812 3456 7890']);

        $this->get('/')->assertSee('https://wa.me/6281234567890', false);
    }
}
