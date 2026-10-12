<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'token_number',
        'booking_date',
        'booking_time',
        'status',
        'consultation_type',
        'google_meet_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public static function autoCancelExpiredPendingBookings()
    {
        $now = now('Asia/Kolkata');
        $pendingBookings = self::where('status', 'Pending')->get();

        foreach ($pendingBookings as $booking) {
            try {
                $timeString = $booking->booking_time;
                if (str_contains($timeString, ' to ')) {
                    $parts = explode(' to ', $timeString);
                    $timeString = trim($parts[0]);
                }
                $appointmentTime = \Carbon\Carbon::parse($booking->booking_date . ' ' . $timeString, 'Asia/Kolkata');
                $diffInMinutes = $now->diffInMinutes($appointmentTime, false);

                // If appointment start time is in the past (diff < 0)
                if ($diffInMinutes < 0) {
                    $booking->status = 'Cancelled';
                    $booking->save();

                    // Create Patient Notification
                    UserNotification::create([
                        'user_id' => $booking->user_id,
                        'title'   => 'Appointment Expired & Cancelled ❌',
                        'message' => "Your appointment scheduled for " . \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') . " at " . \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') . " with Dr. " . ($booking->doctor->name ?? 'practitioner') . " was automatically cancelled because it wasn't approved before the start time.",
                        'type'    => 'appointment_expired_cancelled',
                        'link'    => route('bookings.my'),
                        'is_read' => false,
                    ]);

                    // Create Doctor Notification
                    if ($booking->doctor_id) {
                        DoctorNotification::create([
                            'doctor_id' => $booking->doctor_id,
                            'title'     => 'Appointment Expired & Cancelled ❌',
                            'message'   => "The pending appointment with patient " . ($booking->user->name ?? 'patient') . " on " . \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') . " at " . \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') . " was automatically cancelled because it wasn't approved before the scheduled start time.",
                            'type'      => 'appointment_expired_cancelled',
                            'link'      => route('doctor.dashboard') . '?filter=all',
                            'is_read'   => false,
                        ]);
                    }

                    // Send email to doctor (Soft-removed)
                    /*
                    if ($booking->doctor && $booking->doctor->email) {
                        try {
                            \Illuminate\Support\Facades\Mail::to($booking->doctor->email)->send(new \App\Mail\AppointmentCancelledByPatientMail($booking));
                        } catch (\Exception $e) {
                            \Log::error("Failed to send automatic cancellation email to doctor: " . $e->getMessage());
                        }
                    }
                    */
                }
            } catch (\Exception $e) {
                \Log::error("Failed to auto-cancel expired booking ID {$booking->id}: " . $e->getMessage());
            }
        }
    }
}
