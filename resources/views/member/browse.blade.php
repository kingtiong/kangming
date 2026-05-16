@extends('layouts.app')
@section('title', __('member.browse_title'))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-2">{{ __('member.browse_heading') }}</h1>
<p class="text-sm text-slate-500 mb-6">{{ __('member.browse_subtitle') }}</p>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($schedules as $s)
        @php $remaining = $s->remainingCapacity(); @endphp
        <div class="card p-5 flex flex-col">
            <div class="flex items-start justify-between">
                <h3 class="font-semibold text-slate-900">{{ $s->section?->service?->localized('name') }}</h3>
                @if ($remaining > 0)
                    <span class="badge bg-emerald-100 text-emerald-800">{{ __('member.left_count', ['count' => $remaining]) }}</span>
                @else
                    <span class="badge bg-rose-100 text-rose-800">{{ __('member.full') }}</span>
                @endif
            </div>
            <p class="text-sm text-slate-600 mt-1">{{ $s->section?->localized('name') }}</p>
            <div class="text-sm text-slate-500 mt-3 space-y-1">
                <div>📅 {{ $s->starts_at->format('D, d M Y, H:i') }} – {{ $s->ends_at->format('H:i') }}</div>
                <div>📍 {{ $s->section?->branch?->localized('name') }}{{ $s->room ? ' · ' . $s->room : '' }}</div>
                @if ($s->teacher)
                    <div>👤 {{ $s->teacher->name }}</div>
                @endif
            </div>
            <div class="mt-auto pt-4">
                @if ($remaining > 0)
                    <form method="POST" action="{{ route('member.book', $s) }}">
                        @csrf
                        <button class="btn btn-primary w-full justify-center">{{ __('member.book_session_btn') }}</button>
                    </form>
                @else
                    <button class="btn btn-outline w-full justify-center cursor-not-allowed opacity-50" disabled>{{ __('member.fully_booked_btn') }}</button>
                @endif
            </div>
        </div>
    @empty
        <p class="text-slate-500 col-span-full">{{ __('member.no_sessions') }}</p>
    @endforelse
</div>

<div class="mt-6">{{ $schedules->links() }}</div>
@endsection
