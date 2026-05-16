<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']) . '-' . Str::random(4);
        Service::create($data);
        return redirect()->route('admin.services.index')->with('status', __('flash.service_created'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request, $service->id);
        $service->update($data);
        return redirect()->route('admin.services.index')->with('status', __('flash.service_updated'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', __('flash.service_deleted'));
    }

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_zh_CN' => ['nullable', 'string', 'max:255'],
            'name_zh_TW' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('services', 'slug')->ignore($id)],
            'category' => ['required', Rule::in(['treatment', 'class', 'consultation', 'other'])],
            'audience' => ['required', Rule::in(['client', 'student', 'both'])],
            'description' => ['nullable', 'string'],
            'description_zh_CN' => ['nullable', 'string'],
            'description_zh_TW' => ['nullable', 'string'],
            'duration_minutes' => ['required', 'integer', 'min:5', 'max:600'],
            'default_price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }
}
