<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $bookings = Booking::with(['service', 'schedule.section.branch'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $upcoming = Schedule::with(['section.service', 'section.branch', 'teacher'])
            ->whereHas('bookings', fn ($q) => $q->where('user_id', $user->id)
                ->whereNotIn('status', ['cancelled', 'no_show']))
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(8)
            ->get();

        $services = Service::where('is_active', true)
            ->where(function ($q) use ($user) {
                $q->where('audience', $user->role)->orWhere('audience', 'both');
            })
            ->orderBy('name')
            ->take(8)
            ->get();

        return view('member.dashboard', compact('bookings', 'upcoming', 'services'));
    }
}
