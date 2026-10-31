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
    public function test_inventory_paginates_and_preserves_filters(): void
    {
        $this->get('/inventory?per_page=6&page=2&sort=price_asc')->assertOk()->assertSee('Showing 7')->assertSee('Page 1')->assertSee('per_page=6', false);
        $this->get('/inventory?per_page=500')->assertSessionHasErrors('per_page');
    }
    public function test_extended_filters_use_combined_criteria(): void
    {
        $this->get('/inventory?drivetrain=AWD&exterior=Black&location=Aurora%2C%20CO')->assertOk()->assertSee('Save Mercedes-Benz S 580')->assertDontSee('Save BMW 740i');
    }
    public function test_compare_shows_selected_cars_and_limits_selection(): void
    {
        $this->get('/compare?ids=1,2')->assertOk()->assertSee('Mercedes-Benz')->assertSee('911 Carrera S')->assertSee('Title status')->assertSee('4MATIC')->assertSee('18,400 mi')->assertDontSee('@else');
        $this->get('/compare?ids=1,2,3,4')->assertSessionHasErrors('ids');
    }
    public function test_contact_details_and_gallery_are_available(): void
    {
        $this->get('/contact')->assertOk()->assertSee('50 S Havana St Ste 512')->assertSee('(720) 800-0033')->assertSee('Load Interactive Map');
        $this->get('/vehicles/1')->assertOk()->assertSee('Open full-screen vehicle photograph')->assertSee('Price & fee information', false)->assertSee('<title>2023 Mercedes-Benz S 580',false);
    }
    public function test_public_information_pages(): void
    {
        foreach (['financing','sell-trade','about','contact','privacy','saved','car-finder','compare'] as $page) $this->get('/'.$page)->assertOk();
    }
}




