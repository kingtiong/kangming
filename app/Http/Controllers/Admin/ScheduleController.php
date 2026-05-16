<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['section.service', 'section.branch', 'teacher'])
            ->orderBy('starts_at', 'desc')
            ->paginate(20);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create', $this->refs());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Schedule::create($data);
        return redirect()->route('admin.schedules.index')->with('status', __('flash.schedule_created'));
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.schedules.edit', $this->refs() + compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $this->validated($request);
        $schedule->update($data);
        return redirect()->route('admin.schedules.index')->with('status', __('flash.schedule_updated'));
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('status', __('flash.schedule_deleted'));
    }

    private function refs(): array
    {
        return [
            'sections' => Section::with('branch', 'service')->orderBy('name')->get(),
            'teachers' => User::where('role', User::ROLE_TEACHER)->orderBy('name')->get(),
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'section_id' => ['required', 'exists:sections,id'],
            'teacher_id' => ['nullable', 'exists:users,id'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'room' => ['nullable', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1', 'max:999'],
            'status' => ['required', Rule::in(['scheduled', 'cancelled', 'completed'])],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
