<?php
namespace Tests\Feature;

use Tests\TestCase;

class ShowroomTest extends TestCase
{
    public function test_homepage_displays_new_design(): void
    {
        $this->get('/')->assertOk()->assertSee('Find Your')->assertSee('Search Vehicles')->assertSee('Shop by');
    }
    public function test_combined_inventory_filters(): void
    {
        $this->get('/inventory?make=Porsche&max_price=80000')->assertOk()->assertSee('Cayenne')->assertDontSee('Save Porsche 911 Carrera S');
    }
    public function test_inventory_category_empty_state(): void
    {
        $this->get('/inventory?category=Truck')->assertOk()->assertSee('No vehicles found');
    }
    public function test_inventory_rejects_invalid_price(): void
    {
        $this->get('/inventory?max_price=invalid')->assertSessionHasErrors('max_price');
    }
    public function test_price_sort_and_electric_filter(): void
    {
        $cars = \App\Support\DemoInventory::filter(['sort'=>'price_asc']);
        $this->assertSame(7,$cars[0]['id']);
        $this->get('/inventory?category=Electric')->assertOk()->assertSee('BMW i4')->assertDontSee('Save Porsche 911 Carrera S');
    }
    public function test_vehicle_details_and_missing_vehicle(): void
    {
        $this->get('/vehicles/2')->assertOk()->assertSee('DEMO-0002')->assertSee('Illustrative');
        $this->get('/vehicles/999')->assertNotFound();
    }
    public function test_public_information_pages(): void
    {
        foreach (['financing','sell-trade','about','contact','privacy','saved'] as $page) $this->get('/'.$page)->assertOk();
    }
}

