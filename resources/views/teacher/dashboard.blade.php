@extends('layouts.app')
@section('title', __('teacher.dashboard_title'))
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('teacher.welcome', ['name' => auth()->user()->name]) }}</h1>
    <p class="text-sm text-slate-500">{{ __('teacher.subtitle') }}</p>
</div>

@if ($branches->count())
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-3">{{ __('teacher.branches_you_manage') }}</h2>
        <div class="grid sm:grid-cols-3 gap-3">
            @foreach ($branches as $b)
                <div class="card p-4">
                    <div class="font-medium">{{ $b->localized('name') }}</div>
                    <div class="text-xs text-slate-500">{{ $b->code }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="grid lg:grid-cols-2 gap-6">
    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200"><h2 class="font-semibold">{{ __('teacher.my_sections') }}</h2></div>
        <table class="w-full">
            <thead><tr><th>{{ __('teacher.col_code') }}</th><th>{{ __('teacher.col_name') }}</th><th>{{ __('teacher.col_service') }}</th><th>{{ __('teacher.col_branch') }}</th></tr></thead>
            <tbody>
            @forelse ($sections as $s)
                <tr>
                    <td class="font-mono text-xs">{{ $s->code }}</td>
                    <td>{{ $s->localized('name') }}</td>
                    <td>{{ $s->service?->localized('name') }}</td>
                    <td>{{ $s->branch?->localized('name') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-slate-500 py-6">{{ __('teacher.no_sections') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200"><h2 class="font-semibold">{{ __('teacher.upcoming_classes') }}</h2></div>
        <table class="w-full">
            <thead><tr><th>{{ __('teacher.col_when') }}</th><th>{{ __('teacher.col_section') }}</th><th>{{ __('teacher.col_branch') }}</th></tr></thead>
            <tbody>
            @forelse ($upcoming as $u)
                <tr>
                    <td>{{ $u->starts_at->format('d M, H:i') }}</td>
                    <td>{{ $u->section?->localized('name') }}</td>
                    <td>{{ $u->section?->branch?->localized('name') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-slate-500 py-6">{{ __('teacher.no_classes') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
