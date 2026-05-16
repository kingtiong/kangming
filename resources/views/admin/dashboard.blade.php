@extends('layouts.app')
@section('title', __('admin.dashboard.title'))
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.dashboard.title') }}</h1>
    <p class="text-sm text-slate-500">{{ __('admin.dashboard.subtitle') }}</p>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach ([
        [__('admin.dashboard.stat_branches'), $stats['branches']],
        [__('admin.dashboard.stat_services'), $stats['services']],
        [__('admin.dashboard.stat_sections'), $stats['sections']],
        [__('admin.dashboard.stat_bookings_today'), $stats['bookings_today']],
        [__('admin.dashboard.stat_teachers'), $stats['teachers']],
        [__('admin.dashboard.stat_students'), $stats['students']],
        [__('admin.dashboard.stat_clients'), $stats['clients']],
        [__('admin.dashboard.stat_revenue_mtd'), 'RM ' . number_format((float) $stats['revenue_month'], 2)],
    ] as [$label, $value])
        <div class="card p-4">
            <div class="text-xs uppercase tracking-wider text-slate-500">{{ $label }}</div>
            <div class="text-2xl font-bold text-slate-900 mt-2">{{ $value }}</div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-900">{{ __('admin.dashboard.upcoming_schedules') }}</h2>
            <a href="{{ route('admin.schedules.index') }}" class="text-sm text-emerald-600">{{ __('admin.dashboard.view_all') }}</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead><tr><th>{{ __('admin.dashboard.col_when') }}</th><th>{{ __('admin.dashboard.col_service') }}</th><th>{{ __('admin.dashboard.col_branch') }}</th><th>{{ __('admin.dashboard.col_teacher') }}</th></tr></thead>
                <tbody>
                @forelse ($upcoming as $s)
                    <tr>
                        <td>{{ $s->starts_at->format('d M, H:i') }}</td>
                        <td>{{ $s->section?->service?->localized('name') }}</td>
                        <td>{{ $s->section?->branch?->localized('name') }}</td>
                        <td>{{ $s->teacher?->name ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-slate-500">{{ __('admin.dashboard.no_upcoming') }}</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200">
            <h2 class="font-semibold text-slate-900">{{ __('admin.dashboard.recent_bookings') }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead><tr><th>{{ __('admin.dashboard.col_ref') }}</th><th>{{ __('admin.dashboard.col_member') }}</th><th>{{ __('admin.dashboard.col_service') }}</th><th>{{ __('admin.dashboard.col_status') }}</th></tr></thead>
                <tbody>
                @forelse ($recentBookings as $b)
                    <tr>
                        <td class="font-mono text-xs">{{ $b->reference }}</td>
                        <td>{{ $b->user?->name }}</td>
                        <td>{{ $b->service?->localized('name') }}</td>
                        <td><span class="badge bg-slate-100 text-slate-800">{{ __('member.status.' . $b->status) }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-slate-500">{{ __('admin.dashboard.no_bookings') }}</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
