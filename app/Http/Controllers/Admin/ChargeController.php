<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Charge;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChargeController extends Controller
{
    public function index()
    {
        $charges = Charge::with(['service', 'branch'])->latest()->paginate(20);
        return view('admin.charges.index', compact('charges'));
    }

    public function create()
    {
        $services = Service::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        return view('admin.charges.create', compact('services', 'branches'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Charge::create($data);
        return redirect()->route('admin.charges.index')->with('status', __('flash.charge_created'));
    }

    public function edit(Charge $charge)
    {
        $services = Service::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();
        return view('admin.charges.edit', compact('charge', 'services', 'branches'));
    }

    public function update(Request $request, Charge $charge)
    {
        $data = $this->validated($request);
        $charge->update($data);
        return redirect()->route('admin.charges.index')->with('status', __('flash.charge_updated'));
    }

    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect()->route('admin.charges.index')->with('status', __('flash.charge_deleted'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'label' => ['required', 'string', 'max:255'],
            'label_zh_CN' => ['nullable', 'string', 'max:255'],
            'label_zh_TW' => ['nullable', 'string', 'max:255'],
            'audience' => ['required', Rule::in(['client', 'student', 'both'])],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'session_count' => ['required', 'integer', 'min:1', 'max:999'],
            'valid_from' => ['nullable', 'date'],
            'valid_to' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }
}
