@extends('layouts.app')
@section('title', __('site.meta.branches_title'))
@section('hero')
    <x-page-hero :eyebrow="__('site.branches.hero_eyebrow')" :title="__('site.branches.hero_title')" :subtitle="__('site.branches.hero_subtitle')" />
@endsection
@section('content')
<div class="max-w-6xl mx-auto py-12">
    <div class="space-y-6">
        @foreach ($branches as $b)
            <article class="card overflow-hidden grid md:grid-cols-3">
                <div class="bg-gradient-to-br from-gold-700 via-gold-600 to-gold-800 text-white p-8 flex flex-col justify-center">
                    <p class="text-xs uppercase tracking-[0.2em] text-gold-200">{{ $b->code }}</p>
                    <h3 class="font-display text-3xl mt-2 leading-tight">{{ $b->localized('name') }}</h3>
                    @if ($b->code === 'KMG')
                        <span class="badge bg-white text-gold-700 mt-4 self-start">{{ __('site.branches.hq_badge') }}</span>
                    @endif
                </div>
                <div class="md:col-span-2 p-8">
                    @if ($b->address)
                        <div class="flex items-start gap-3 mb-4">
                            <span class="text-gold-700 mt-1">📍</span>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.address') }}</p>
                                <p class="text-ink-700 mt-1">{{ $b->address }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($b->phone)
                        <div class="flex items-start gap-3 mb-4">
                            <span class="text-gold-700 mt-1">📞</span>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.phone') }}</p>
                                <p class="text-ink-700 mt-1"><a href="tel:{{ preg_replace('/\D/', '', $b->phone) }}" class="hover:text-gold-700">{{ $b->phone }}</a></p>
                            </div>
                        </div>
                    @endif
                    @if ($b->email)
                        <div class="flex items-start gap-3 mb-4">
                            <span class="text-gold-700 mt-1">✉️</span>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.email') }}</p>
                                <p class="text-ink-700 mt-1"><a href="mailto:{{ $b->email }}" class="hover:text-gold-700">{{ $b->email }}</a></p>
                            </div>
                        </div>
                    @endif
                    @if ($b->teacherInCharge)
                        <div class="mt-6 pt-6 border-t border-gold-100 flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-gold-100 text-gold-700 flex items-center justify-center font-display text-xl">
                                {{ strtoupper(substr($b->teacherInCharge->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.in_charge') }}</p>
                                <p class="font-medium text-ink-900 mt-1">{{ $b->teacherInCharge->name }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-16 card p-10 bg-gold-50/60 text-center">
        <h2 class="font-display text-3xl text-ink-900">{{ __('site.branches.hours_title') }}</h2>
        <div class="gold-divider mt-4 w-24 mx-auto mb-6"></div>
        <div class="grid sm:grid-cols-3 gap-6 max-w-2xl mx-auto text-ink-700">
            <div>
                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.hours_weekday_label') }}</p>
                <p class="font-display text-2xl mt-2">{{ __('site.branches.hours_weekday_value') }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.hours_saturday_label') }}</p>
                <p class="font-display text-2xl mt-2">{{ __('site.branches.hours_saturday_value') }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.branches.hours_sunday_label') }}</p>
                <p class="font-display text-2xl mt-2">{{ __('site.branches.hours_sunday_value') }}</p>
            </div>
        </div>
        <p class="text-xs text-ink-700/60 mt-6">{{ __('site.branches.hours_note') }}</p>
    </div>
</div>
@endsection
