@extends('layouts.app')
@section('title', __('member.dashboard_title'))
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('member.welcome', ['name' => auth()->user()->name]) }}</h1>
    <p class="text-sm text-slate-500">{{ __('member.dashboard_subtitle') }}</p>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="card p-5 lg:col-span-2">
        <h2 class="font-semibold text-slate-900 mb-3">{{ __('member.upcoming_sessions') }}</h2>
        @forelse ($upcoming as $s)
            <div class="border-t border-slate-100 py-3 first:border-0 first:pt-0">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium text-slate-900">{{ $s->section?->service?->localized('name') }}</div>
                        <div class="text-sm text-slate-500">{{ __('member.session_at', ['date' => $s->starts_at->format('D, d M · H:i'), 'branch' => $s->section?->branch?->localized('name')]) }}</div>
                    </div>
                    <span class="badge bg-emerald-100 text-emerald-800">{{ __('member.badge_booked') }}</span>
                </div>
            </div>
        @empty
            <p class="text-sm text-slate-500">{{ __('member.no_upcoming_intro') }} <a href="{{ route('member.browse') }}" class="text-emerald-600">{{ __('member.browse_link') }}</a></p>
        @endforelse
    </div>

    <div class="card p-5">
        <h2 class="font-semibold text-slate-900 mb-3">{{ __('member.recent_bookings') }}</h2>
        @forelse ($bookings as $b)
            <div class="border-t border-slate-100 py-2 first:border-0 first:pt-0 text-sm">
                <div class="font-medium">{{ $b->service?->localized('name') ?? __('member.service_fallback') }}</div>
                <div class="text-slate-500 text-xs">{{ $b->reference }} · {{ __('member.status.' . $b->status) }}</div>
            </div>
        @empty
            <p class="text-sm text-slate-500">{{ __('member.no_bookings_short') }}</p>
        @endforelse
    </div>
</div>

<div class="mt-8">
    <h2 class="text-lg font-semibold text-slate-900 mb-4">{{ __('member.recommended_services') }}</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($services as $svc)
            <div class="card p-4">
                <div class="font-medium text-slate-900">{{ $svc->localized('name') }}</div>
                <div class="text-xs text-slate-500 mt-1">{{ __('admin.services.category_options.' . $svc->category) }} · {{ __('member.minutes_short', ['min' => $svc->duration_minutes]) }}</div>
                <div class="mt-3 font-semibold text-emerald-700 text-sm">RM {{ number_format((float) $svc->default_price, 2) }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
