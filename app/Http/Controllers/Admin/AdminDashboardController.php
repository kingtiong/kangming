<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'branches' => Branch::count(),
            'services' => Service::count(),
            'sections' => Section::count(),
            'teachers' => User::where('role', User::ROLE_TEACHER)->count(),
            'students' => User::where('role', User::ROLE_STUDENT)->count(),
            'clients' => User::where('role', User::ROLE_CLIENT)->count(),
            'bookings_today' => Booking::whereDate('created_at', Carbon::today())->count(),
            'revenue_month' => Booking::where('payment_status', 'paid')
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('amount'),
        ];

        $upcoming = Schedule::with(['section.service', 'section.branch', 'teacher'])
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(8)
            ->get();

        $recentBookings = Booking::with(['user', 'service', 'schedule'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'upcoming', 'recentBookings'));
    }
}
