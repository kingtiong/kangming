<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = User::with('branch')->orderBy('name');
        if ($role = $request->query('role')) {
            $q->where('role', $role);
        }
        if ($s = $request->query('q')) {
            $q->where(function ($w) use ($s) {
                $w->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%");
            });
        }
        $users = $q->paginate(25)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        return view('admin.users.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        User::create($data);
        return redirect()->route('admin.users.index')->with('status', __('flash.user_created'));
    }

    public function edit(User $user)
    {
        $branches = Branch::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'branches'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user->id);
        if (empty($data['password'])) {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('status', __('flash.user_updated'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => __('flash.cannot_delete_self')]);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', __('flash.user_deleted'));
    }

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'date_of_birth' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'password' => [$id ? 'nullable' : 'required', 'min:8'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }
}
