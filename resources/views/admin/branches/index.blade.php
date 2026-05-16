@extends('layouts.app')
@section('title', __('admin.branches.title'))
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.branches.title') }}</h1>
        <p class="text-sm text-slate-500">{{ __('admin.branches.subtitle') }}</p>
    </div>
    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary self-start sm:self-auto">{{ __('admin.branches.new') }}</a>
</div>

{{-- Desktop table --}}
<div class="card overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead><tr><th>{{ __('admin.common.name') }}</th><th>{{ __('admin.common.code') }}</th><th>{{ __('admin.common.phone') }}</th><th>{{ __('admin.branches.col_in_charge') }}</th><th>{{ __('admin.common.status') }}</th><th></th></tr></thead>
            <tbody>
            @forelse ($branches as $b)
                <tr>
                    <td class="font-medium text-slate-900">{{ $b->localized('name') }}</td>
                    <td class="font-mono text-xs">{{ $b->code }}</td>
                    <td>{{ $b->phone ?? '—' }}</td>
                    <td>{{ $b->teacherInCharge?->name ?? '—' }}</td>
                    <td>
                        @if ($b->is_active)<span class="badge bg-emerald-100 text-emerald-800">{{ __('admin.common.active') }}</span>
                        @else<span class="badge bg-slate-200 text-slate-700">{{ __('admin.common.inactive') }}</span>@endif
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.branches.edit', $b) }}" class="text-emerald-600 text-sm">{{ __('admin.common.edit') }}</a>
                        <form method="POST" action="{{ route('admin.branches.destroy', $b) }}" class="inline ml-2" onsubmit="return confirm('{{ __('admin.branches.confirm_delete') }}')">
                            @csrf @method('DELETE')
                            <button class="text-rose-600 text-sm">{{ __('admin.common.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-slate-500 py-8">{{ __('admin.branches.no_records') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Mobile cards --}}
<div class="md:hidden space-y-3">
    @forelse ($branches as $b)
        <div class="card p-4">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div>
                    <div class="font-medium text-slate-900">{{ $b->localized('name') }}</div>
                    <div class="text-xs font-mono text-slate-500 mt-0.5">{{ $b->code }}</div>
                </div>
                @if ($b->is_active)<span class="badge bg-emerald-100 text-emerald-800">{{ __('admin.common.active') }}</span>
                @else<span class="badge bg-slate-200 text-slate-700">{{ __('admin.common.inactive') }}</span>@endif
            </div>
            <dl class="text-sm space-y-1.5">
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.common.phone') }}</dt><dd class="text-slate-800 text-right">{{ $b->phone ?? '—' }}</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.branches.col_in_charge') }}</dt><dd class="text-slate-800 text-right">{{ $b->teacherInCharge?->name ?? '—' }}</dd></div>
            </dl>
            <div class="mt-3 pt-3 border-t border-slate-100 flex gap-4">
                <a href="{{ route('admin.branches.edit', $b) }}" class="text-emerald-600 text-sm font-medium">{{ __('admin.common.edit') }}</a>
                <form method="POST" action="{{ route('admin.branches.destroy', $b) }}" class="inline ml-auto" onsubmit="return confirm('{{ __('admin.branches.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button class="text-rose-600 text-sm font-medium">{{ __('admin.common.delete') }}</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card p-6 text-center text-slate-500">{{ __('admin.branches.no_records') }}</div>
    @endforelse
</div>

<div class="mt-4">{{ $branches->links() }}</div>
@endsection
