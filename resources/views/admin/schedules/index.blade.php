@extends('layouts.app')
@section('title', __('admin.schedules.title'))
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.schedules.title') }}</h1>
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary self-start sm:self-auto">{{ __('admin.schedules.new') }}</a>
</div>

{{-- Desktop table --}}
<div class="card overflow-hidden hidden md:block">
    <table class="w-full">
        <thead><tr><th>{{ __('admin.dashboard.col_when') }}</th><th>{{ __('teacher.col_section') }}</th><th>{{ __('admin.common.branch') }}</th><th>{{ __('admin.common.teacher') }}</th><th>{{ __('admin.schedules.col_room') }}</th><th>{{ __('admin.common.status') }}</th><th></th></tr></thead>
        <tbody>
        @forelse ($schedules as $s)
            <tr>
                <td>{{ $s->starts_at?->format('d M Y, H:i') }} – {{ $s->ends_at?->format('H:i') }}</td>
                <td>{{ $s->section?->localized('name') }} ({{ $s->section?->service?->localized('name') }})</td>
                <td>{{ $s->section?->branch?->localized('name') }}</td>
                <td>{{ $s->teacher?->name ?? '—' }}</td>
                <td>{{ $s->room ?? '—' }}</td>
                <td><span class="badge bg-slate-100 text-slate-800">{{ __('admin.schedules.status_options.' . $s->status) }}</span></td>
                <td class="text-right">
                    <a href="{{ route('admin.schedules.edit', $s) }}" class="text-emerald-600 text-sm">{{ __('admin.common.edit') }}</a>
                    <form method="POST" action="{{ route('admin.schedules.destroy', $s) }}" class="inline ml-2" onsubmit="return confirm('{{ __('admin.common.confirm_delete') }}')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-sm">{{ __('admin.common.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-slate-500 py-8">{{ __('admin.schedules.no_records') }}</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile cards --}}
<div class="md:hidden space-y-3">
    @forelse ($schedules as $s)
        <div class="card p-4">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div>
                    <div class="font-medium text-slate-900">{{ $s->section?->localized('name') }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">{{ $s->section?->service?->localized('name') }}</div>
                </div>
                <span class="badge bg-slate-100 text-slate-800">{{ __('admin.schedules.status_options.' . $s->status) }}</span>
            </div>
            <dl class="text-sm space-y-1.5">
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.dashboard.col_when') }}</dt><dd class="text-slate-800 text-right">{{ $s->starts_at?->format('d M, H:i') }} – {{ $s->ends_at?->format('H:i') }}</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.common.branch') }}</dt><dd class="text-slate-800 text-right">{{ $s->section?->branch?->localized('name') }}</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.common.teacher') }}</dt><dd class="text-slate-800 text-right">{{ $s->teacher?->name ?? '—' }}</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.schedules.col_room') }}</dt><dd class="text-slate-800 text-right">{{ $s->room ?? '—' }}</dd></div>
            </dl>
            <div class="mt-3 pt-3 border-t border-slate-100 flex gap-4">
                <a href="{{ route('admin.schedules.edit', $s) }}" class="text-emerald-600 text-sm font-medium">{{ __('admin.common.edit') }}</a>
                <form method="POST" action="{{ route('admin.schedules.destroy', $s) }}" class="inline ml-auto" onsubmit="return confirm('{{ __('admin.common.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button class="text-rose-600 text-sm font-medium">{{ __('admin.common.delete') }}</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card p-6 text-center text-slate-500">{{ __('admin.schedules.no_records') }}</div>
    @endforelse
</div>

<div class="mt-4">{{ $schedules->links() }}</div>
@endsection
