<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Doctor;
use App\Models\District;
use App\Models\DoctorCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OtherStateDoctorSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed some categories
        DoctorCategory::create(['name' => 'General Medicine']);
    }

    public function test_other_state_doctor_is_grouped_in_other_location_list()
    {
        // 1. Create a Kerala district and doctor
        $ernakulam = District::create(['name' => 'Ernakulam']);
        $keralaDoc = Doctor::create([
            'name' => 'Dr. Kerala Vaidya',
            'email' => 'kerala@vaidya.com',
            'password' => bcrypt('password123'),
            'phone' => '9876543210',
            'medical_registration_no' => 'KMC/12345/2020',
            'specialization_category' => 'General Medicine',
            'district_id' => $ernakulam->id,
            'current_location' => null,
            'address' => 'Ernakulam, Kerala',
            'qualification' => 'BAMS',
            'experience' => 5,
            'consultation_fee' => 300,
            'consultation_type' => 'Both',
            'is_active' => true,
        ]);

        // 2. Create an Other State district (e.g. Chennai) and doctor
        $chennai = District::create(['name' => 'Chennai']);
        $otherStateDoc = Doctor::create([
            'name' => 'Dr. Other State Vaidya',
            'email' => 'otherstate@vaidya.com',
            'password' => bcrypt('password123'),
            'phone' => '9876543211',
            'medical_registration_no' => 'TNC/12345/2020',
            'specialization_category' => 'General Medicine',
            'district_id' => $chennai->id,
            'current_location' => null,
            'address' => 'Chennai, Tamil Nadu',
            'qualification' => 'BAMS',
            'experience' => 8,
            'consultation_fee' => 400,
            'consultation_type' => 'Both',
            'is_active' => true,
        ]);

        // 3. Create an Abroad doctor
        $abroadDistrict = District::create(['name' => 'Abroad / Other']);
        $abroadDoc = Doctor::create([
            'name' => 'Dr. Abroad Vaidya',
            'email' => 'abroad@vaidya.com',
            'password' => bcrypt('password123'),
            'phone' => '9876543212',
            'medical_registration_no' => 'UKC/12345/2020',
            'specialization_category' => 'General Medicine',
            'district_id' => $abroadDistrict->id,
            'current_location' => 'London, UK',
            'address' => 'London, UK',
            'qualification' => 'BAMS',
            'experience' => 12,
            'consultation_fee' => 1000,
            'consultation_type' => 'Online',
            'is_active' => true,
        ]);

        // Query the default doctors index
        $responseAll = $this->get(route('doctors.index'));
        $responseAll->assertStatus(200);
        $responseAll->assertSee('Dr. Kerala Vaidya');
        $responseAll->assertSee('Dr. Other State Vaidya');
        $responseAll->assertSee('Dr. Abroad Vaidya');

        // Query with type=Other (Other / Abroad)
        $responseOther = $this->get(route('doctors.index', ['type' => 'Other']));
        $responseOther->assertStatus(200);
        $responseOther->assertSee('Dr. Other State Vaidya');
        $responseOther->assertSee('Dr. Abroad Vaidya');
        $responseOther->assertDontSee('Dr. Kerala Vaidya');
    }
}
