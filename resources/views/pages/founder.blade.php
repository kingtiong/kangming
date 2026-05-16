@extends('layouts.app')
@section('title', __('site.meta.founder_title'))
@section('hero')
    <x-page-hero :eyebrow="__('site.founder.hero_eyebrow')" :title="__('site.founder.hero_title')" :subtitle="__('site.founder.hero_subtitle')" />
@endsection
@section('content')
<div class="max-w-5xl mx-auto py-12 grid lg:grid-cols-12 gap-12">
    <aside class="lg:col-span-4">
        <div class="card overflow-hidden sticky top-24">
            <img src="{{ url('/img/namecard.jpeg') }}" alt="" class="w-full">
            <div class="p-6">
                <p class="font-cn text-xl text-gold-700">{{ __('site.founder.card_name_cn') }}</p>
                <p class="font-display text-2xl text-ink-900 mt-1">{{ __('site.founder.card_name_en') }}</p>
                <p class="text-xs uppercase tracking-wider text-gold-600 mt-2">{{ __('site.founder.card_title_cn') }}</p>
                <p class="text-sm text-ink-700/80 mt-1">{{ __('site.founder.card_title_en') }}</p>
                <div class="mt-5 pt-5 border-t border-gold-100 space-y-2 text-sm">
                    <a href="https://wa.me/601167693193" class="flex items-center gap-2 text-ink-700 hover:text-gold-700">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.38 5.07L2 22l5.05-1.32C8.49 21.51 10.18 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
                        011-6769 3193
                    </a>
                    <a href="mailto:tanteikee@gmail.com" class="flex items-center gap-2 text-ink-700 hover:text-gold-700">
                        ✉️ tanteikee@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </aside>
    <div class="lg:col-span-8">
        <div class="prose-gold text-ink-700 space-y-5 leading-relaxed text-lg">
            <p>{{ __('site.founder.p1') }}</p>
            <p>{{ __('site.founder.p2_quote') }}</p>
        </div>

        <h2 class="font-display text-3xl text-ink-900 mt-12">{{ __('site.founder.background_title') }}</h2>
        <div class="gold-divider mt-4 mb-6 w-24"></div>
        <ul class="space-y-4 text-ink-700">
            @foreach ((array) __('site.founder.background_items') as $item)
                <li class="flex gap-4">
                    <span class="flex-shrink-0 mt-1 h-2 w-2 rounded-full bg-gold-500"></span>
                    <div>
                        <h4 class="font-medium text-ink-900">{{ $item[0] }}</h4>
                        <p class="text-sm text-ink-700/75 mt-1">{{ $item[1] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="my-12 card overflow-hidden">
            <img src="{{ url('/img/hero-students.jpg') }}" alt="" class="w-full">
            <div class="p-5 bg-gold-50/50">
                <p class="text-sm text-ink-700/80 italic">{{ __('site.founder.photo_caption') }}</p>
            </div>
        </div>

        <h2 class="font-display text-3xl text-ink-900 mt-12">{{ __('site.founder.words_title') }}</h2>
        <div class="gold-divider mt-4 mb-6 w-24"></div>
        <blockquote class="border-l-4 border-gold-500 pl-6 italic text-ink-700 text-lg leading-relaxed">
            {{ __('site.founder.words_quote') }}
        </blockquote>

        <div class="mt-12 flex flex-wrap gap-3">
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('site.founder.cta_book') }}</a>
            <a href="{{ route('services') }}" class="btn btn-outline">{{ __('site.founder.cta_courses') }}</a>
        </div>
    </div>
</div>
@endsection
