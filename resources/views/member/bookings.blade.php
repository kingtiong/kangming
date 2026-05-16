@extends('layouts.app')
@section('title', __('member.bookings_title'))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('member.bookings_title') }}</h1>
<div class="card overflow-hidden">
    <table class="w-full">
        <thead><tr><th>{{ __('member.col_reference') }}</th><th>{{ __('member.col_service') }}</th><th>{{ __('member.col_date') }}</th><th>{{ __('member.col_branch') }}</th><th>{{ __('member.col_amount') }}</th><th>{{ __('member.col_status') }}</th><th>{{ __('member.col_payment') }}</th><th></th></tr></thead>
        <tbody>
        @forelse ($bookings as $b)
            <tr>
                <td class="font-mono text-xs">{{ $b->reference }}</td>
                <td class="font-medium">{{ $b->service?->localized('name') }}</td>
                <td>{{ $b->schedule?->starts_at?->format('d M Y, H:i') ?? '—' }}</td>
                <td>{{ $b->schedule?->section?->branch?->localized('name') ?? '—' }}</td>
                <td>{{ $b->currency }} {{ number_format((float) $b->amount, 2) }}</td>
                <td><span class="badge bg-slate-100 text-slate-800">{{ __('member.status.' . $b->status) }}</span></td>
                <td><span class="badge {{ $b->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ __('member.payment.' . $b->payment_status) }}</span></td>
                <td class="text-right">
                    @if (!in_array($b->status, ['cancelled', 'attended', 'no_show']))
                        <form method="POST" action="{{ route('member.bookings.cancel', $b) }}" onsubmit="return confirm('{{ __('member.cancel_confirm') }}')">
                            @csrf
                            <button class="text-rose-600 text-sm">{{ __('member.cancel') }}</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center text-slate-500 py-8">{{ __('member.no_bookings_long') }} <a href="{{ route('member.browse') }}" class="text-emerald-600">{{ __('member.browse_sessions') }}</a>.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $bookings->links() }}</div>
@endsection
