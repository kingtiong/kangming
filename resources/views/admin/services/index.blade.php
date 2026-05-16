@extends('layouts.app')
@section('title', __('admin.services.title'))
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.services.title') }}</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary self-start sm:self-auto">{{ __('admin.services.new') }}</a>
</div>

{{-- Desktop table --}}
<div class="card overflow-hidden hidden md:block">
    <table class="w-full">
        <thead><tr><th>{{ __('admin.common.name') }}</th><th>{{ __('admin.services.col_category') }}</th><th>{{ __('admin.services.col_audience') }}</th><th>{{ __('admin.services.col_duration') }}</th><th>{{ __('admin.services.col_default_price') }}</th><th></th></tr></thead>
        <tbody>
        @forelse ($services as $s)
            <tr>
                <td class="font-medium">{{ $s->localized('name') }}</td>
                <td><span class="badge bg-sky-100 text-sky-800">{{ __('admin.services.category_options.' . $s->category) }}</span></td>
                <td><span class="badge bg-slate-100 text-slate-800">{{ __('admin.services.audience_options.' . $s->audience) }}</span></td>
                <td>{{ __('member.minutes_short', ['min' => $s->duration_minutes]) }}</td>
                <td>RM {{ number_format((float) $s->default_price, 2) }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.services.edit', $s) }}" class="text-emerald-600 text-sm">{{ __('admin.common.edit') }}</a>
                    <form method="POST" action="{{ route('admin.services.destroy', $s) }}" class="inline ml-2" onsubmit="return confirm('{{ __('admin.services.confirm_delete') }}')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-sm">{{ __('admin.common.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-slate-500 py-8">{{ __('admin.services.no_records') }}</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile cards --}}
<div class="md:hidden space-y-3">
    @forelse ($services as $s)
        <div class="card p-4">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div class="font-medium text-slate-900">{{ $s->localized('name') }}</div>
                <div class="font-display text-lg text-emerald-700 whitespace-nowrap">RM {{ number_format((float) $s->default_price, 2) }}</div>
            </div>
            <div class="flex flex-wrap gap-2 mb-3">
                <span class="badge bg-sky-100 text-sky-800">{{ __('admin.services.category_options.' . $s->category) }}</span>
                <span class="badge bg-slate-100 text-slate-800">{{ __('admin.services.audience_options.' . $s->audience) }}</span>
                <span class="badge bg-slate-100 text-slate-700">{{ __('member.minutes_short', ['min' => $s->duration_minutes]) }}</span>
            </div>
            <div class="pt-3 border-t border-slate-100 flex gap-4">
                <a href="{{ route('admin.services.edit', $s) }}" class="text-emerald-600 text-sm font-medium">{{ __('admin.common.edit') }}</a>
                <form method="POST" action="{{ route('admin.services.destroy', $s) }}" class="inline ml-auto" onsubmit="return confirm('{{ __('admin.services.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button class="text-rose-600 text-sm font-medium">{{ __('admin.common.delete') }}</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card p-6 text-center text-slate-500">{{ __('admin.services.no_records') }}</div>
    @endforelse
</div>

<div class="mt-4">{{ $services->links() }}</div>
@endsection
