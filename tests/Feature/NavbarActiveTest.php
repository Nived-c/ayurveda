<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NavbarActiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_navbar_adds_active_class_to_home_by_default()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        // The Home link should have active class
        $response->assertSee('class="nav-link active">Home', false);
    }

    public function test_navbar_adds_active_class_to_products_page()
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('class="nav-link active">Products', false);
    }

    public function test_navbar_adds_active_class_to_doctors_page()
    {
        $response = $this->get(route('doctors.index'));

        $response->assertStatus(200);
        $response->assertSee('class="nav-link active">Doctors', false);
    }

    public function test_navbar_adds_active_class_to_astrology_page()
    {
        $response = $this->get(route('medical_astrology'));

        $response->assertStatus(200);
        $response->assertSee('class="nav-link active"> Medical Astrology', false);
    }
}
