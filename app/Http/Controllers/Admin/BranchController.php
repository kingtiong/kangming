<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('teacherInCharge')->orderBy('name')->paginate(20);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        $teachers = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();
        return view('admin.branches.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Branch::create($data);
        return redirect()->route('admin.branches.index')->with('status', __('flash.branch_created'));
    }

    public function edit(Branch $branch)
    {
        $teachers = User::where('role', User::ROLE_TEACHER)->orderBy('name')->get();
        return view('admin.branches.edit', compact('branch', 'teachers'));
    }

    public function update(Request $request, Branch $branch)
    {
        $data = $this->validated($request, $branch->id);
        $branch->update($data);
        return redirect()->route('admin.branches.index')->with('status', __('flash.branch_updated'));
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('status', __('flash.branch_deleted'));
    }

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_zh_CN' => ['nullable', 'string', 'max:255'],
            'name_zh_TW' => ['nullable', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('branches', 'code')->ignore($id)],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'teacher_in_charge_id' => ['nullable', 'exists:users,id'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }
}
