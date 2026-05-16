@extends('layouts.app')
@section('title', __('site.meta.contact_title'))
@section('hero')
    <x-page-hero :eyebrow="__('site.contact.hero_eyebrow')" :title="__('site.contact.hero_title')" :subtitle="__('site.contact.hero_subtitle')" />
@endsection
@section('content')
<div class="max-w-6xl mx-auto py-12 grid lg:grid-cols-2 gap-10">
    <div>
        <h2 class="font-display text-3xl text-ink-900">{{ __('site.contact.get_in_touch') }}</h2>
        <div class="gold-divider mt-4 w-24 mb-6"></div>

        <div class="space-y-5">
            <a href="https://wa.me/601167693193" class="card p-6 flex items-start gap-4 hover:shadow-md transition group">
                <div class="h-12 w-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.38 5.07L2 22l5.05-1.32C8.49 21.51 10.18 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.contact.wa_eyebrow') }}</p>
                    <h3 class="font-display text-xl text-ink-900 mt-1">{{ __('site.contact.wa_title') }}</h3>
                    <p class="text-ink-700 mt-1">{{ __('site.contact.wa_phone') }}</p>
                    <p class="text-xs text-ink-700/60 mt-2">{{ __('site.contact.wa_hint') }}</p>
                </div>
            </a>

            <a href="mailto:tanteikee@gmail.com" class="card p-6 flex items-start gap-4 hover:shadow-md transition">
                <div class="h-12 w-12 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
                <div class="flex-grow">
                    <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.contact.email_eyebrow') }}</p>
                    <h3 class="font-display text-xl text-ink-900 mt-1">{{ __('site.contact.email_value') }}</h3>
                    <p class="text-xs text-ink-700/60 mt-2">{{ __('site.contact.email_hint') }}</p>
                </div>
            </a>

            <div class="card p-6 flex items-start gap-4">
                <div class="h-12 w-12 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-gold-600">{{ __('site.contact.hq_eyebrow') }}</p>
                    <h3 class="font-display text-xl text-ink-900 mt-1">{{ __('site.contact.hq_title') }}</h3>
                    <p class="text-ink-700 mt-2 leading-relaxed">{!! __('site.contact.hq_address_html') !!}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 card p-6 bg-gold-50/60">
            <h4 class="font-display text-lg text-ink-900">{{ __('site.contact.hours_title') }}</h4>
            <ul class="mt-3 text-sm text-ink-700 space-y-1">
                <li class="flex justify-between"><span>{{ __('site.contact.hours_weekday') }}</span><span class="font-medium">{{ __('site.contact.hours_weekday_value') }}</span></li>
                <li class="flex justify-between"><span>{{ __('site.contact.hours_saturday') }}</span><span class="font-medium">{{ __('site.contact.hours_saturday_value') }}</span></li>
                <li class="flex justify-between"><span>{{ __('site.contact.hours_sunday') }}</span><span class="font-medium">{{ __('site.contact.hours_sunday_value') }}</span></li>
            </ul>
        </div>
    </div>

    <div>
        <h2 class="font-display text-3xl text-ink-900">{{ __('site.contact.map_title') }}</h2>
        <div class="gold-divider mt-4 w-24 mb-6"></div>
        <div class="card overflow-hidden">
            <iframe
                src="https://www.google.com/maps?q=Medan+Saujana+Kamunting+Perak&output=embed"
                class="w-full h-96 border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="mt-8 card p-8 bg-ink-900 text-white">
            <h3 class="font-display text-2xl">{{ __('site.contact.first_visit_title') }}</h3>
            <div class="gold-divider mt-3 w-24 mb-5 from-gold-300"></div>
            <ul class="space-y-3 text-sm text-white/85">
                @foreach ((array) __('site.contact.first_visit_items') as $tip)
                    <li class="flex gap-3"><span class="text-gold-300">✓</span> {{ $tip }}</li>
                @endforeach
            </ul>
            <a href="{{ route('register') }}" class="btn btn-primary bg-gold-500 hover:bg-gold-600 mt-6">{{ __('site.contact.first_visit_cta') }}</a>
        </div>
    </div>
</div>
@endsection
