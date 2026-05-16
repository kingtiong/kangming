<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Section;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['service', 'branch', 'teacher'])->latest()->paginate(20);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create', $this->refs());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Section::create($data);
        return redirect()->route('admin.sections.index')->with('status', __('flash.section_created'));
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', $this->refs() + compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $this->validated($request, $section->id);
        $section->update($data);
        return redirect()->route('admin.sections.index')->with('status', __('flash.section_updated'));
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('status', __('flash.section_deleted'));
    }

    private function refs(): array
    {
        return [
            'services' => Service::orderBy('name')->get(),
            'branches' => Branch::orderBy('name')->get(),
            'teachers' => User::where('role', User::ROLE_TEACHER)->orderBy('name')->get(),
        ];
    }

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_zh_CN' => ['nullable', 'string', 'max:255'],
            'name_zh_TW' => ['nullable', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('sections', 'code')->ignore($id)],
            'service_id' => ['required', 'exists:services,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'teacher_id' => ['nullable', 'exists:users,id'],
            'audience' => ['required', Rule::in(['client', 'student', 'both'])],
            'capacity' => ['required', 'integer', 'min:1', 'max:999'],
            'starts_on' => ['nullable', 'date'],
            'ends_on' => ['nullable', 'date', 'after_or_equal:starts_on'],
            'description' => ['nullable', 'string'],
            'description_zh_CN' => ['nullable', 'string'],
            'description_zh_TW' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['draft', 'open', 'closed', 'completed'])],
        ]);
    }
}
