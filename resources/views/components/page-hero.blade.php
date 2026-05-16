@props(['eyebrow', 'title', 'subtitle' => null])
<section class="bg-ink-900 text-white py-20 lg:py-28 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-20 -right-20 h-96 w-96 rounded-full bg-gold-500 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 h-96 w-96 rounded-full bg-gold-700 blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-sm uppercase tracking-[0.25em] text-gold-300 font-medium">{{ $eyebrow }}</p>
        <h1 class="font-display text-5xl lg:text-6xl mt-3">{{ $title }}</h1>
        @if ($subtitle)
            <div class="gold-divider mt-6 w-24 mx-auto"></div>
            <p class="mt-6 text-lg text-white/75 max-w-2xl mx-auto">{{ $subtitle }}</p>
        @endif
    </div>
</section>
