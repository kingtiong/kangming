@extends('layouts.app')
@section('title', __('site.meta.services_title'))
@section('hero')
    <x-page-hero :eyebrow="__('site.services.hero_eyebrow')" :title="__('site.services.hero_title')" :subtitle="__('site.services.hero_subtitle')" />
@endsection
@section('content')
@php
    $categoryLabels = [
        'treatment' => [__('site.services.cat_treatment_title'), __('site.services.cat_treatment_blurb')],
        'class' => [__('site.services.cat_class_title'), __('site.services.cat_class_blurb')],
        'consultation' => [__('site.services.cat_consultation_title'), __('site.services.cat_consultation_blurb')],
        'other' => [__('site.services.cat_other_title'), __('site.services.cat_other_blurb')],
    ];
@endphp
<div class="py-12 max-w-7xl mx-auto">
    @foreach ($categoryLabels as $cat => [$title, $blurb])
        @if (isset($services[$cat]))
            <section class="mb-16">
                <div class="mb-8">
                    <h2 class="font-display text-3xl lg:text-4xl text-ink-900">{{ $title }}</h2>
                    <div class="gold-divider mt-3 mb-4 w-24"></div>
                    <p class="text-ink-700/70">{{ $blurb }}</p>
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    @foreach ($services[$cat] as $svc)
                        <div class="card overflow-hidden hover:shadow-lg transition">
                            <div class="h-1.5 bg-gradient-to-r from-gold-300 via-gold-500 to-gold-700"></div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="font-display text-xl text-ink-900 leading-tight">{{ $svc->localized('name') }}</h3>
                                    <span class="badge bg-gold-100 text-gold-800 ml-3 flex-shrink-0">{{ __('admin.services.audience_options.' . $svc->audience) }}</span>
                                </div>
                                <p class="text-sm text-ink-700/80 leading-relaxed">{{ $svc->localized('description') }}</p>
                                <div class="mt-5 pt-4 border-t border-gold-100 flex items-center justify-between">
                                    <div class="text-sm text-ink-700/70">
                                        <span class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.services.duration_label') }}</span>
                                        <span class="ml-2">{{ __('site.services.duration_value', ['min' => $svc->duration_minutes]) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs text-ink-700/60">{{ __('site.services.price_from') }}</span>
                                        <span class="font-display text-xl text-gold-700 ml-1">RM {{ number_format((float) $svc->default_price, 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach

    <section class="my-16 card p-10 bg-gradient-to-br from-gold-50 to-white text-center">
        <h2 class="font-display text-3xl text-ink-900">{{ __('site.services.pack_title') }}</h2>
        <p class="text-ink-700/70 mt-3 max-w-2xl mx-auto">{!! __('site.services.pack_body') !!}</p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('site.services.pack_cta_signup') }}</a>
            <a href="https://wa.me/601167693193" class="btn btn-outline">{{ __('site.services.pack_cta_ask') }}</a>
        </div>
    </section>
</div>
@endsection
