<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('default_price')->take(6)->get();
        $branches = Branch::where('is_active', true)->orderBy('id')->take(6)->get();
        $upcomingClasses = Schedule::with(['section.service', 'section.branch', 'teacher'])
            ->whereHas('section', fn ($q) => $q->where('audience', 'student')->where('status', 'open'))
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(4)
            ->get();
        return view('home', compact('services', 'branches', 'upcomingClasses'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function founder()
    {
        return view('pages.founder');
    }

    public function servicesPage()
    {
        $services = Service::where('is_active', true)->orderBy('category')->orderBy('name')->get()->groupBy('category');
        return view('pages.services', compact('services'));
    }

    public function branchesPage()
    {
        $branches = Branch::with('teacherInCharge')->where('is_active', true)->orderBy('id')->get();
        return view('pages.branches', compact('branches'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student', 'client' => redirect()->route('member.dashboard'),
            default => abort(403),
        };
    }
}
