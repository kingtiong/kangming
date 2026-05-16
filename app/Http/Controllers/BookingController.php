<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Charge;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function browse(Request $request)
    {
        $user = $request->user();
        $schedules = Schedule::with(['section.service', 'section.branch', 'teacher'])
            ->where('starts_at', '>=', now())
            ->where('status', 'scheduled')
            ->whereHas('section', function ($q) use ($user) {
                $q->where('status', 'open')->where(function ($w) use ($user) {
                    $w->where('audience', $user->role)->orWhere('audience', 'both');
                });
            })
            ->orderBy('starts_at')
            ->paginate(20);

        return view('member.browse', compact('schedules'));
    }

    public function book(Request $request, Schedule $schedule)
    {
        $user = $request->user();
        if (!$user->isMember()) {
            abort(403);
        }

        if ($schedule->starts_at->isPast()) {
            return back()->withErrors(['error' => __('flash.booking_session_started')]);
        }

        if ($schedule->remainingCapacity() <= 0) {
            return back()->withErrors(['error' => __('flash.booking_full')]);
        }

        $exists = Booking::where('schedule_id', $schedule->id)
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['cancelled'])
            ->exists();
        if ($exists) {
            return back()->withErrors(['error' => __('flash.booking_duplicate')]);
        }

        $section = $schedule->section;
        $service = $section->service;
        $charge = Charge::where('service_id', $service->id)
            ->where('is_active', true)
            ->where(function ($q) use ($section) {
                $q->whereNull('branch_id')->orWhere('branch_id', $section->branch_id);
            })
            ->where(function ($q) use ($user) {
                $q->where('audience', $user->role)->orWhere('audience', 'both');
            })
            ->orderBy('amount')
            ->first();

        Booking::create([
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'section_id' => $section->id,
            'service_id' => $service->id,
            'charge_id' => $charge?->id,
            'amount' => $charge?->amount ?? $service->default_price,
            'currency' => $charge?->currency ?? 'MYR',
            'status' => 'confirmed',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('member.bookings')->with('status', __('flash.booking_confirmed'));
    }

    public function index(Request $request)
    {
        $bookings = Booking::with(['service', 'schedule.section.branch', 'schedule.teacher'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);
        return view('member.bookings', compact('bookings'));
    }

    public function cancel(Request $request, Booking $booking)
    {
        if ($booking->user_id !== $request->user()->id) {
            abort(403);
        }
        if (in_array($booking->status, ['cancelled', 'attended', 'no_show'])) {
            return back()->withErrors(['error' => __('flash.booking_cannot_cancel')]);
        }
        $booking->update(['status' => 'cancelled']);
        return back()->with('status', __('flash.booking_cancelled'));
    }
}
