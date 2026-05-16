<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Section;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $sections = Section::with(['service', 'branch'])
            ->where('teacher_id', $user->id)
            ->orderBy('starts_on', 'desc')
            ->take(10)
            ->get();

        $upcoming = Schedule::with(['section.service', 'section.branch'])
            ->where('teacher_id', $user->id)
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(10)
            ->get();

        $branches = $user->teachingBranches()->orderBy('name')->get();

        return view('teacher.dashboard', compact('sections', 'upcoming', 'branches'));
    }
}
