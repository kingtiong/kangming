@extends('layouts.app')
@section('title', __('site.meta.home_title'))

@section('hero')
<section class="relative overflow-hidden bg-ink-900 text-white">
    <div class="absolute inset-0">
        <img src="{{ url('/img/hero-students.jpg') }}" alt="" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-ink-900 via-ink-900/85 to-ink-900/40"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-3 mb-6">
                <span class="h-px w-8 bg-gold-300"></span>
                <span class="font-cn text-gold-300 text-sm tracking-widest">{{ __('site.home.hero_eyebrow') }}</span>
            </div>
            <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-medium leading-tight text-white">
                {{ __('site.home.hero_title_a') }}<br>
                <span class="text-gold-300 italic">{{ __('site.home.hero_title_b') }}</span>
            </h1>
            <p class="mt-8 text-lg lg:text-xl text-white/80 max-w-2xl leading-relaxed">
                {!! __('site.home.hero_intro') !!}
            </p>
            <div class="mt-10 flex flex-wrap gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('site.home.cta_register') }}</a>
                <a href="{{ route('founder') }}" class="btn btn-outline bg-white/5 border-white/30 text-white hover:bg-white/15 hover:border-gold-300">{{ __('site.home.cta_meet_founder') }}</a>
                <a href="https://wa.me/601167693193" class="btn btn-ghost text-white/90 hover:text-gold-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.38 5.07L2 22l5.05-1.32C8.49 21.51 10.18 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    011-6769 3193
                </a>
            </div>
            <div class="mt-12 grid grid-cols-3 gap-6 max-w-xl">
                <div>
                    <div class="font-display text-3xl text-gold-300">3+</div>
                    <div class="text-xs uppercase tracking-wider text-white/60 mt-1">{{ __('site.home.stat_branches') }}</div>
                </div>
                <div>
                    <div class="font-display text-3xl text-gold-300">董氏</div>
                    <div class="text-xs uppercase tracking-wider text-white/60 mt-1">{{ __('site.home.stat_lineage') }}</div>
                </div>
                <div>
                    <div class="font-display text-3xl text-gold-300">2020</div>
                    <div class="text-xs uppercase tracking-wider text-white/60 mt-1">{{ __('site.home.stat_established') }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
{{-- Introduction band --}}
<section class="py-16 lg:py-24 -mt-8">
    <div class="grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
            <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.heritage_eyebrow') }}</p>
            <h2 class="font-display text-4xl lg:text-5xl text-ink-900 mt-3 leading-tight">
                {{ __('site.home.heritage_title') }}
            </h2>
            <div class="gold-divider mt-6 mb-6 w-24"></div>
            <div class="prose-gold text-ink-700">
                <p>{!! __('site.home.heritage_p1') !!}</p>
                <p>{!! __('site.home.heritage_p2') !!}</p>
            </div>
            <a href="{{ route('about') }}" class="btn btn-outline mt-6">{{ __('site.home.heritage_cta') }}</a>
        </div>
        <div class="lg:col-span-7 relative">
            <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ url('/img/hero-students.jpg') }}" alt="" class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-xl border border-gold-100 p-5 hidden sm:block max-w-xs">
                <p class="font-cn text-gold-700 text-lg leading-tight">{{ __('site.home.inscription_cn') }}</p>
                <p class="text-xs text-ink-700/70 mt-1">{{ __('site.home.inscription_caption') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- What we offer --}}
<section class="py-16 lg:py-24 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 bg-gold-50/60">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.services_eyebrow') }}</p>
            <h2 class="font-display text-4xl lg:text-5xl text-ink-900 mt-3">{{ __('site.home.services_title') }}</h2>
            <div class="gold-divider mt-6 mb-6 w-24 mx-auto"></div>
            <p class="text-ink-700">{{ __('site.home.services_intro') }}</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="card p-8 hover:shadow-lg transition">
                <div class="h-14 w-14 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10M7 12h10"/></svg>
                </div>
                <h3 class="font-display text-2xl text-ink-900">{{ __('site.home.pillar_treatment_title') }}</h3>
                <p class="text-sm text-ink-700/80 mt-3 leading-relaxed">{{ __('site.home.pillar_treatment_body') }}</p>
                <a href="{{ route('services') }}" class="text-gold-700 text-sm font-medium mt-4 inline-block hover:text-gold-800">{{ __('site.home.pillar_treatment_cta') }}</a>
            </div>
            <div class="card p-8 hover:shadow-lg transition">
                <div class="h-14 w-14 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.624L16.5 21.75l-.398-1.126a3.375 3.375 0 00-2.226-2.226L12.75 18l1.126-.398a3.375 3.375 0 002.226-2.226l.398-1.126.398 1.126a3.375 3.375 0 002.226 2.226l1.126.398-1.126.398a3.375 3.375 0 00-2.226 2.226z"/></svg>
                </div>
                <h3 class="font-display text-2xl text-ink-900">{{ __('site.home.pillar_aesthetics_title') }}</h3>
                <p class="text-sm text-ink-700/80 mt-3 leading-relaxed">{{ __('site.home.pillar_aesthetics_body') }}</p>
                <a href="{{ route('services') }}" class="text-gold-700 text-sm font-medium mt-4 inline-block hover:text-gold-800">{{ __('site.home.pillar_aesthetics_cta') }}</a>
            </div>
            <div class="card p-8 hover:shadow-lg transition">
                <div class="h-14 w-14 rounded-xl bg-gold-100 text-gold-700 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443"/></svg>
                </div>
                <h3 class="font-display text-2xl text-ink-900">{{ __('site.home.pillar_training_title') }}</h3>
                <p class="text-sm text-ink-700/80 mt-3 leading-relaxed">{{ __('site.home.pillar_training_body') }}</p>
                <a href="{{ route('services') }}" class="text-gold-700 text-sm font-medium mt-4 inline-block hover:text-gold-800">{{ __('site.home.pillar_training_cta') }}</a>
            </div>
        </div>
    </div>
</section>

{{-- Featured services from DB --}}
<section class="py-16 lg:py-24">
    <div class="flex items-end justify-between mb-10">
        <div>
            <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.featured_eyebrow') }}</p>
            <h2 class="font-display text-3xl lg:text-4xl text-ink-900 mt-2">{{ __('site.home.featured_title') }}</h2>
        </div>
        <a href="{{ route('services') }}" class="hidden sm:inline text-gold-700 hover:text-gold-800 text-sm font-medium">{{ __('site.home.featured_view_all') }}</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($services as $svc)
            <div class="card overflow-hidden hover:shadow-lg transition group">
                <div class="h-2 bg-gradient-to-r from-gold-300 via-gold-500 to-gold-700"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <span class="badge bg-gold-100 text-gold-800">{{ __('admin.services.category_options.' . $svc->category) }}</span>
                        <span class="text-xs text-ink-700/60">{{ __('site.home.featured_minutes', ['min' => $svc->duration_minutes]) }}</span>
                    </div>
                    <h3 class="font-display text-xl text-ink-900 leading-tight">{{ $svc->localized('name') }}</h3>
                    <p class="text-sm text-ink-700/70 mt-3 leading-relaxed">{{ Str::limit($svc->localized('description'), 120) }}</p>
                    <div class="mt-5 pt-4 border-t border-gold-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-ink-700/60">{{ __('site.home.featured_from') }}</span>
                            <span class="font-display text-xl text-gold-700 ml-1">RM {{ number_format((float) $svc->default_price, 0) }}</span>
                        </div>
                        <a href="{{ route('register') }}" class="text-sm text-gold-700 font-medium hover:text-gold-800">{{ __('site.home.featured_book') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Founder spotlight --}}
<section class="py-16 lg:py-24 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 bg-ink-900 text-white">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
        <div class="relative">
            <div class="aspect-[3/4] max-w-md rounded-2xl overflow-hidden shadow-2xl ring-4 ring-gold-500/30">
                <img src="{{ url('/img/namecard.jpeg') }}" alt="" class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-6 -right-6 bg-gold-500 text-ink-900 rounded-xl shadow-xl p-5 max-w-[200px] hidden sm:block">
                <div class="font-display text-lg leading-tight">陳世益</div>
                <div class="text-xs mt-1 opacity-80">{{ __('site.home.founder_card_role') }}</div>
                <div class="font-display text-sm mt-2 leading-tight">{{ __('site.home.founder_card_name_en') }}</div>
            </div>
        </div>
        <div>
            <p class="text-sm uppercase tracking-[0.25em] text-gold-300 font-medium">{{ __('site.home.founder_eyebrow') }}</p>
            <h2 class="font-display text-4xl lg:text-5xl mt-3 leading-tight">
                {{ __('site.home.founder_title_a') }}<br>
                <span class="text-gold-300 italic">{{ __('site.home.founder_title_b') }}</span>
            </h2>
            <div class="gold-divider mt-6 mb-6 w-24 from-gold-300"></div>
            <div class="text-white/80 leading-relaxed space-y-4">
                <p>{{ __('site.home.founder_p1') }}</p>
                <p>{{ __('site.home.founder_p2') }}</p>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('founder') }}" class="btn btn-primary">{{ __('site.home.founder_cta_bio') }}</a>
                <a href="https://wa.me/601167693193" class="btn btn-outline bg-white/5 border-white/30 text-white hover:bg-white/15">{{ __('site.home.founder_cta_whatsapp') }}</a>
            </div>
        </div>
    </div>
</section>

{{-- Branches --}}
<section class="py-16 lg:py-24">
    <div class="text-center max-w-3xl mx-auto mb-12">
        <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.branches_eyebrow') }}</p>
        <h2 class="font-display text-4xl lg:text-5xl text-ink-900 mt-3">{{ __('site.home.branches_title') }}</h2>
        <div class="gold-divider mt-6 mb-6 w-24 mx-auto"></div>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($branches as $b)
            <div class="card p-6 hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="font-display text-2xl text-ink-900">{{ $b->localized('name') }}</h3>
                    @if ($b->code === 'KMG')
                        <span class="badge bg-gold-500 text-white">{{ __('site.home.branches_hq') }}</span>
                    @endif
                </div>
                <p class="text-xs uppercase tracking-wider text-gold-600 font-medium">{{ $b->code }}</p>
                @if ($b->address)
                    <p class="text-sm text-ink-700/80 mt-3 leading-relaxed">📍 {{ $b->address }}</p>
                @endif
                @if ($b->phone)
                    <p class="text-sm text-ink-700/80 mt-2">📞 {{ $b->phone }}</p>
                @endif
                @if ($b->teacherInCharge)
                    <div class="mt-4 pt-4 border-t border-gold-100">
                        <p class="text-xs uppercase tracking-wider text-ink-700/50">{{ __('site.home.branches_in_charge') }}</p>
                        <p class="text-sm font-medium text-gold-700 mt-1">{{ $b->teacherInCharge->name }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

{{-- Upcoming classes --}}
@if ($upcomingClasses->count())
<section class="py-16 lg:py-24 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 bg-gold-50/60">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.classes_eyebrow') }}</p>
            <h2 class="font-display text-4xl lg:text-5xl text-ink-900 mt-3">{{ __('site.home.classes_title') }}</h2>
            <div class="gold-divider mt-6 w-24 mx-auto"></div>
        </div>
        <div class="grid md:grid-cols-2 gap-4 max-w-4xl mx-auto">
            @foreach ($upcomingClasses as $sched)
                <div class="card p-5 flex items-start gap-4">
                    <div class="flex-shrink-0 text-center bg-gold-100 rounded-lg p-3 min-w-[64px]">
                        <div class="text-xs uppercase tracking-wider text-gold-700">{{ $sched->starts_at->format('M') }}</div>
                        <div class="font-display text-2xl text-gold-800 leading-none mt-1">{{ $sched->starts_at->format('d') }}</div>
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-medium text-ink-900">{{ $sched->section?->service?->localized('name') }}</h4>
                        <p class="text-xs text-ink-700/70 mt-1">{{ $sched->starts_at->format('l, H:i') }} · {{ $sched->section?->branch?->localized('name') }}</p>
                        @if ($sched->teacher)
                            <p class="text-xs text-gold-700 mt-1">{{ __('site.home.classes_with', ['name' => $sched->teacher->name]) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('site.home.classes_cta') }}</a>
        </div>
    </div>
</section>
@endif

{{-- Why Kang Ming --}}
<section class="py-16 lg:py-24">
    <div class="text-center max-w-3xl mx-auto mb-14">
        <p class="text-sm uppercase tracking-[0.25em] text-gold-600 font-medium">{{ __('site.home.why_eyebrow') }}</p>
        <h2 class="font-display text-4xl lg:text-5xl text-ink-900 mt-3">{{ __('site.home.why_title') }}</h2>
        <div class="gold-divider mt-6 w-24 mx-auto"></div>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ((array) __('site.home.why_items') as $i => $item)
            <div class="card p-6">
                <div class="font-display text-3xl text-gold-300">0{{ $i + 1 }}</div>
                <h4 class="font-display text-xl text-ink-900 mt-3">{{ $item[0] }}</h4>
                <p class="text-sm text-ink-700/70 mt-2 leading-relaxed">{{ $item[1] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="py-20 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gold-700 via-gold-600 to-gold-800 text-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="font-display text-4xl lg:text-5xl leading-tight">{{ __('site.home.cta_title') }}</h2>
        <p class="mt-5 text-lg text-white/85 max-w-2xl mx-auto">{{ __('site.home.cta_body') }}</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('register') }}" class="btn bg-white text-gold-700 hover:bg-gold-50">{{ __('site.home.cta_create') }}</a>
            <a href="https://wa.me/601167693193" class="btn border border-white/40 text-white hover:bg-white/10">{{ __('site.home.cta_whatsapp') }}</a>
        </div>
        <p class="text-xs text-white/60 mt-6">{{ __('site.home.cta_note') }}</p>
    </div>
</section>
@endsection
