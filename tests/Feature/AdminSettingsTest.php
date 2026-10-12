<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
        ]);
    }

    public function test_admin_can_access_contact_settings_page()
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->get(route('admin.settings.contact'));

        $response->assertStatus(200);
        $response->assertSee('Portal Contact Settings');
    }

    public function test_admin_can_update_contact_settings()
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.settings.contact.update'), [
                'contact_phone' => '9999988888',
                'contact_email' => 'admin_contact@test.com',
            ]);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('settings', [
            'key' => 'contact_phone',
            'value' => '9999988888',
        ]);
        
        $this->assertDatabaseHas('settings', [
            'key' => 'contact_email',
            'value' => 'admin_contact@test.com',
        ]);
    }

    public function test_admin_contact_settings_validation()
    {
        // 1. Test empty fields
        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.settings.contact.update'), [
                'contact_phone' => '',
                'contact_email' => '',
            ]);
        $response->assertSessionHasErrors(['contact_phone', 'contact_email']);

        // 2. Test invalid phone and email formats
        $response2 = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.settings.contact.update'), [
                'contact_phone' => '1234567890', // starts with 1
                'contact_email' => 'invalid-email',
            ]);
        $response2->assertSessionHasErrors(['contact_phone', 'contact_email']);
    }

    public function test_home_page_renders_configured_contact_info()
    {
        Setting::create(['key' => 'contact_phone', 'value' => '7777766666']);
        Setting::create(['key' => 'contact_email', 'value' => 'custom@ayurveda.com']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('7777766666');
        $response->assertSee('custom@ayurveda.com');
        $response->assertDontSee('Our Office');
        $response->assertDontSee('Operating Hours');
    }
}
