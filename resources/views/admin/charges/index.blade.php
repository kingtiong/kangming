@extends('layouts.app')
@section('title', __('admin.charges.title'))
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.charges.title') }}</h1>
    <a href="{{ route('admin.charges.create') }}" class="btn btn-primary self-start sm:self-auto">{{ __('admin.charges.new') }}</a>
</div>

{{-- Desktop table --}}
<div class="card overflow-hidden hidden md:block">
    <table class="w-full">
        <thead><tr><th>{{ __('admin.charges.col_label') }}</th><th>{{ __('admin.common.service') }}</th><th>{{ __('admin.common.branch') }}</th><th>{{ __('admin.common.audience') }}</th><th>{{ __('admin.charges.col_amount') }}</th><th>{{ __('admin.charges.col_sessions') }}</th><th></th></tr></thead>
        <tbody>
        @forelse ($charges as $c)
            <tr>
                <td class="font-medium">{{ $c->localized('label') }}</td>
                <td>{{ $c->service?->localized('name') }}</td>
                <td>{{ $c->branch?->localized('name') ?? __('admin.charges.all') }}</td>
                <td><span class="badge bg-slate-100 text-slate-800">{{ __('admin.services.audience_options.' . $c->audience) }}</span></td>
                <td class="font-semibold">{{ $c->currency }} {{ number_format((float) $c->amount, 2) }}</td>
                <td>{{ $c->session_count }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.charges.edit', $c) }}" class="text-emerald-600 text-sm">{{ __('admin.common.edit') }}</a>
                    <form method="POST" action="{{ route('admin.charges.destroy', $c) }}" class="inline ml-2" onsubmit="return confirm('{{ __('admin.common.confirm_delete') }}')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-sm">{{ __('admin.common.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center text-slate-500 py-8">{{ __('admin.charges.no_records') }}</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile cards --}}
<div class="md:hidden space-y-3">
    @forelse ($charges as $c)
        <div class="card p-4">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div>
                    <div class="font-medium text-slate-900">{{ $c->localized('label') }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">{{ $c->service?->localized('name') }}</div>
                </div>
                <div class="font-display text-lg text-emerald-700 whitespace-nowrap">{{ $c->currency }} {{ number_format((float) $c->amount, 2) }}</div>
            </div>
            <dl class="text-sm space-y-1.5">
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.common.branch') }}</dt><dd class="text-slate-800 text-right">{{ $c->branch?->localized('name') ?? __('admin.charges.all') }}</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.common.audience') }}</dt><dd class="text-right"><span class="badge bg-slate-100 text-slate-800">{{ __('admin.services.audience_options.' . $c->audience) }}</span></dd></div>
                <div class="flex justify-between gap-3"><dt class="text-slate-500">{{ __('admin.charges.col_sessions') }}</dt><dd class="text-slate-800 text-right">{{ $c->session_count }}</dd></div>
            </dl>
            <div class="mt-3 pt-3 border-t border-slate-100 flex gap-4">
                <a href="{{ route('admin.charges.edit', $c) }}" class="text-emerald-600 text-sm font-medium">{{ __('admin.common.edit') }}</a>
                <form method="POST" action="{{ route('admin.charges.destroy', $c) }}" class="inline ml-auto" onsubmit="return confirm('{{ __('admin.common.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button class="text-rose-600 text-sm font-medium">{{ __('admin.common.delete') }}</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card p-6 text-center text-slate-500">{{ __('admin.charges.no_records') }}</div>
    @endforelse
</div>

<div class="mt-4">{{ $charges->links() }}</div>
@endsection
