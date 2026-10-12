<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\District;
use App\Models\DoctorToken;
use App\Models\UserNotification;
use App\Models\DoctorNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class NotificationAlertTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $doctor;
    private $district;

    protected function setUp(): void
    {
        parent::setUp();

        $this->district = District::create(['name' => 'Kottayam']);

        $this->user = User::create([
            'name' => 'Patient Alice',
            'email' => 'alice@example.com',
            'phone' => '9876543210',
            'password' => Hash::make('password123'),
        ]);

        $this->doctor = Doctor::create([
            'name' => 'Dr. Bob',
            'email' => 'bob@example.com',
            'phone' => '9876543211',
            'password' => Hash::make('password123'),
            'password_plain' => 'password123',
            'medical_registration_no' => 'KMC/12345/2020',
            'specialization_category' => 'Ayurveda',
            'district_id' => $this->district->id,
            'address' => 'Sample Clinic Address 123',
            'qualification' => 'BAMS',
            'experience' => 5,
            'consultation_fee' => 500,
            'consultation_type' => 'Both',
            'is_active' => true,
        ]);
    }

    public function test_user_gets_reminder_alert_5_minutes_before_unconfirmed_appointment()
    {
        // Create a booking scheduled 3 minutes from now (which is within the 5-minute window)
        $bookingTime = now('Asia/Kolkata')->addMinutes(3)->format('H:i');
        $booking = DoctorToken::create([
            'user_id' => $this->user->id,
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->toDateString(),
            'booking_time' => $bookingTime,
            'token_number' => 1,
            'status' => 'Pending',
            'consultation_type' => 'Online',
        ]);

        // Login as patient
        $this->actingAs($this->user, 'web');

        // Verify that polling endpoint creates the alert notification record
        $response = $this->get(route('notifications.unread_latest'));

        $response->assertStatus(200);
        $response->assertJson([
            'has_notification' => true,
            'title' => 'No Confirmation from Doctor ⚠️',
            'type' => 'appointment_no_confirmation',
            'booking_id' => (string)$booking->id,
            'doctors_link' => route('doctors.index'),
        ]);

        // Assert notification database record was created
        $this->assertDatabaseHas('user_notifications', [
            'user_id' => $this->user->id,
            'type' => 'appointment_no_confirmation',
        ]);
    }

    public function test_unconfirmed_appointment_is_automatically_cancelled_when_time_passes()
    {
        // Create a booking scheduled 10 minutes ago (which is in the past)
        $bookingTime = now('Asia/Kolkata')->subMinutes(10)->format('H:i');
        $booking = DoctorToken::create([
            'user_id' => $this->user->id,
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->toDateString(),
            'booking_time' => $bookingTime,
            'token_number' => 1,
            'status' => 'Pending',
            'consultation_type' => 'Online',
        ]);

        // Login as patient
        $this->actingAs($this->user, 'web');

        // Trigger notifications endpoint to run auto-cancellation script
        $response = $this->get(route('notifications.unread_latest'));

        // Assert the booking status is now automatically Cancelled in the database
        $this->assertDatabaseHas('doctor_tokens', [
            'id' => $booking->id,
            'status' => 'Cancelled',
        ]);

        // Assert expired cancellation notifications were created for both patient and doctor
        $this->assertDatabaseHas('user_notifications', [
            'user_id' => $this->user->id,
            'type' => 'appointment_expired_cancelled',
        ]);

        $this->assertDatabaseHas('doctor_notifications', [
            'doctor_id' => $this->doctor->id,
            'type' => 'appointment_expired_cancelled',
        ]);
    }

    public function test_patient_can_cancel_appointment_via_ajax()
    {
        $booking = DoctorToken::create([
            'user_id' => $this->user->id,
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->addDay()->toDateString(),
            'booking_time' => '10:30',
            'token_number' => 1,
            'status' => 'Booked',
            'consultation_type' => 'Online',
        ]);

        $this->actingAs($this->user, 'web');

        $response = $this->post(route('bookings.cancel', $booking->id), [], [
            'X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Appointment has been cancelled successfully.'
        ]);
    }

    public function test_doctor_receives_in_app_notification_when_patient_cancels()
    {
        $booking = DoctorToken::create([
            'user_id' => $this->user->id,
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->addDay()->toDateString(),
            'booking_time' => '10:30',
            'token_number' => 1,
            'status' => 'Booked',
            'consultation_type' => 'Online',
        ]);

        // Login as patient
        $this->actingAs($this->user, 'web');

        // Cancel the booking
        $response = $this->post(route('bookings.cancel', $booking->id));

        $response->assertStatus(302);
        
        // Assert doctor notification record was stored
        $this->assertDatabaseHas('doctor_notifications', [
            'doctor_id' => $this->doctor->id,
            'type' => 'appointment_cancelled',
        ]);

        // Login as doctor and poll unread notification
        $this->actingAs($this->doctor, 'doctor');

        $notifResponse = $this->get(route('doctor.notifications.unread_latest'));
        $notifResponse->assertStatus(200);
        $notifResponse->assertJson([
            'has_notification' => true,
            'title' => 'Appointment Cancelled by Patient ❌',
        ]);
    }

    public function test_doctor_receives_in_app_notification_when_patient_reschedules()
    {
        $booking = DoctorToken::create([
            'user_id' => $this->user->id,
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->addDay()->toDateString(),
            'booking_time' => '10:30',
            'token_number' => 1,
            'status' => 'Booked',
            'consultation_type' => 'Online',
        ]);

        // Login as patient
        $this->actingAs($this->user, 'web');

        // Reschedule to another day
        $response = $this->post(route('bookings.reschedule.update', $booking->id), [
            'doctor_id' => $this->doctor->id,
            'booking_date' => now('Asia/Kolkata')->addDays(2)->toDateString(),
            'booking_time' => '11:00',
            'consultation_type' => 'Online',
        ]);

        $response->assertStatus(302);

        // Assert doctor notification record was stored
        $this->assertDatabaseHas('doctor_notifications', [
            'doctor_id' => $this->doctor->id,
            'type' => 'appointment_rescheduled',
        ]);
    }
}
