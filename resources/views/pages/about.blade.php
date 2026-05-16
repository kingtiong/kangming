@extends('layouts.app')
@section('title', __('site.meta.about_title'))
@section('hero')
    <x-page-hero :eyebrow="__('site.about.hero_eyebrow')" :title="__('site.about.hero_title')" :subtitle="__('site.about.hero_subtitle')" />
@endsection
@section('content')
<div class="max-w-4xl mx-auto py-12">
    <div class="prose-gold text-ink-700 space-y-6 text-lg leading-relaxed">
        <p>{!! __('site.about.p1') !!}</p>
        <p>{!! __('site.about.p2') !!}</p>
    </div>

    <div class="my-12 grid sm:grid-cols-3 gap-6">
        @foreach ((array) __('site.about.stats') as $stat)
            <div class="card p-6 text-center">
                <p class="text-xs uppercase tracking-wider text-gold-600">{{ $stat[0] }}</p>
                <p class="font-display text-3xl text-ink-900 mt-2">{{ $stat[1] }}</p>
                <p class="text-xs text-ink-700/60 mt-1">{{ $stat[2] }}</p>
            </div>
        @endforeach
    </div>

    <div class="card overflow-hidden my-12">
        <img src="{{ url('/img/hero-students.jpg') }}" alt="" class="w-full">
        <div class="p-6 bg-gold-50/50">
            <p class="text-sm text-ink-700/80 italic">{!! __('site.about.ceremony_caption') !!}</p>
        </div>
    </div>

    <h2 class="font-display text-3xl text-ink-900 mt-12">{{ __('site.about.philosophy_title') }}</h2>
    <div class="gold-divider mt-4 mb-6 w-24"></div>
    <div class="prose-gold text-ink-700 space-y-5 leading-relaxed">
        <p>{{ __('site.about.philosophy_p1') }}</p>
        <p>{{ __('site.about.philosophy_p2') }}</p>
    </div>

    <h2 class="font-display text-3xl text-ink-900 mt-12">{{ __('site.about.expect_title') }}</h2>
    <div class="gold-divider mt-4 mb-6 w-24"></div>
    <ul class="space-y-4 text-ink-700">
        @foreach ((array) __('site.about.expect_items') as $item)
            <li class="flex gap-4">
                <span class="flex-shrink-0 mt-1 h-8 w-8 rounded-full bg-gold-100 text-gold-700 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </span>
                <div>
                    <h4 class="font-medium text-ink-900">{{ $item[0] }}</h4>
                    <p class="text-sm text-ink-700/75 mt-1">{{ $item[1] }}</p>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-16 text-center bg-gold-50/60 rounded-2xl p-10">
        <h3 class="font-display text-3xl text-ink-900">{{ __('site.about.visit_title') }}</h3>
        <p class="text-ink-700/70 mt-3">{{ __('site.about.visit_body') }}</p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('site.about.visit_cta_member') }}</a>
            <a href="{{ route('contact') }}" class="btn btn-outline">{{ __('site.about.visit_cta_contact') }}</a>
        </div>
    </div>
</div>
@endsection
