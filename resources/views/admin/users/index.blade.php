@extends('layouts.app')
@section('title', __('admin.users.title'))
@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('admin.users.title') }}</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary self-start sm:self-auto">{{ __('admin.users.new') }}</a>
</div>

<form method="GET" class="card p-4 mb-4 grid grid-cols-1 sm:grid-cols-[1fr_auto_auto] sm:items-end gap-3">
    <div>
        <label class="label">{{ __('admin.users.search_label') }}</label>
        <input name="q" value="{{ request('q') }}" placeholder="{{ __('admin.users.search_placeholder') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.users.role') }}</label>
        <select name="role" class="input">
            <option value="">{{ __('admin.users.role_all') }}</option>
            @foreach (\App\Models\User::ROLES as $k => $v)
                <option value="{{ $k }}" {{ request('role') === $k ? 'selected' : '' }}>{{ __('common.roles.' . $k) }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-outline">{{ __('admin.common.filter') }}</button>
</form>

{{-- Desktop table --}}
<div class="card overflow-hidden hidden md:block">
    <table class="w-full">
        <thead><tr><th>{{ __('admin.common.name') }}</th><th>{{ __('admin.common.email') }}</th><th>{{ __('admin.users.col_role') }}</th><th>{{ __('admin.users.col_branch') }}</th><th>{{ __('admin.common.status') }}</th><th></th></tr></thead>
        <tbody>
        @forelse ($users as $u)
            <tr>
                <td class="font-medium">{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-emerald-100 text-emerald-800">{{ __('common.roles.' . $u->role) }}</span></td>
                <td>{{ $u->branch?->localized('name') ?? '—' }}</td>
                <td>
                    @if ($u->is_active)<span class="badge bg-emerald-100 text-emerald-800">{{ __('admin.common.active') }}</span>
                    @else<span class="badge bg-slate-200 text-slate-700">{{ __('admin.common.inactive') }}</span>@endif
                </td>
                <td class="text-right">
                    <a href="{{ route('admin.users.edit', $u) }}" class="text-emerald-600 text-sm">{{ __('admin.common.edit') }}</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline ml-2" onsubmit="return confirm('{{ __('admin.users.confirm_delete') }}')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-sm">{{ __('admin.common.delete') }}</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-slate-500 py-8">{{ __('admin.users.no_records') }}</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile cards --}}
<div class="md:hidden space-y-3">
    @forelse ($users as $u)
        <div class="card p-4">
            <div class="flex items-start justify-between gap-3 mb-2">
                <div class="min-w-0">
                    <div class="font-medium text-slate-900 truncate">{{ $u->name }}</div>
                    <div class="text-xs text-slate-500 mt-0.5 truncate">{{ $u->email }}</div>
                </div>
                @if ($u->is_active)<span class="badge bg-emerald-100 text-emerald-800">{{ __('admin.common.active') }}</span>
                @else<span class="badge bg-slate-200 text-slate-700">{{ __('admin.common.inactive') }}</span>@endif
            </div>
            <div class="flex flex-wrap gap-2 mb-3">
                <span class="badge bg-emerald-100 text-emerald-800">{{ __('common.roles.' . $u->role) }}</span>
                @if ($u->branch)<span class="badge bg-slate-100 text-slate-700">{{ $u->branch->localized('name') }}</span>@endif
            </div>
            <div class="pt-3 border-t border-slate-100 flex gap-4">
                <a href="{{ route('admin.users.edit', $u) }}" class="text-emerald-600 text-sm font-medium">{{ __('admin.common.edit') }}</a>
                <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline ml-auto" onsubmit="return confirm('{{ __('admin.users.confirm_delete') }}')">
                    @csrf @method('DELETE')
                    <button class="text-rose-600 text-sm font-medium">{{ __('admin.common.delete') }}</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card p-6 text-center text-slate-500">{{ __('admin.users.no_records') }}</div>
    @endforelse
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection
