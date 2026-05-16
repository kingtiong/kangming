<footer class="bg-ink-900 text-ink-100 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid md:grid-cols-4 gap-10">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ url('/img/logo.svg') }}" alt="" class="h-12 w-12 brightness-0 invert opacity-90">
                <div class="leading-tight">
                    <div class="font-display text-xl text-gold-200 font-semibold tracking-wide">{{ __('nav.brand') }}</div>
                    <div class="text-[10px] uppercase tracking-[0.2em] text-gold-300">{{ __('nav.tagline') }}</div>
                </div>
            </div>
            <p class="font-cn text-sm text-ink-100/70 mb-3">{{ __('footer.brand_subtitle') }}</p>
            <p class="text-xs text-ink-100/60 leading-relaxed">
                {{ __('footer.reg_no') }}<br>
                {{ __('footer.tagline') }}
            </p>
        </div>
        <div>
            <h4 class="text-gold-300 text-sm font-semibold uppercase tracking-wider mb-4">{{ __('footer.visit_us') }}</h4>
            <p class="text-sm text-ink-100/80 leading-relaxed">
                @foreach ((array) __('footer.address_lines') as $line)
                    {{ $line }}@if (!$loop->last)<br>@endif
                @endforeach
            </p>
        </div>
        <div>
            <h4 class="text-gold-300 text-sm font-semibold uppercase tracking-wider mb-4">{{ __('footer.get_in_touch') }}</h4>
            <p class="text-sm text-ink-100/80 leading-relaxed">
                <a href="https://wa.me/601167693193" class="hover:text-gold-200">{{ __('footer.whatsapp_label') }}</a><br>
                <a href="mailto:tanteikee@gmail.com" class="hover:text-gold-200">tanteikee@gmail.com</a><br>
                {{ __('footer.founder_name') }}<br>
                <span class="text-ink-100/60 text-xs">{{ __('footer.founder_cn') }}</span>
            </p>
        </div>
        <div>
            <h4 class="text-gold-300 text-sm font-semibold uppercase tracking-wider mb-4">{{ __('footer.quick_links') }}</h4>
            <ul class="space-y-2 text-sm text-ink-100/80">
                <li><a href="{{ route('about') }}" class="hover:text-gold-200">{{ __('footer.about_us') }}</a></li>
                <li><a href="{{ route('founder') }}" class="hover:text-gold-200">{{ __('footer.our_founder') }}</a></li>
                <li><a href="{{ route('services') }}" class="hover:text-gold-200">{{ __('footer.services') }}</a></li>
                <li><a href="{{ route('branches') }}" class="hover:text-gold-200">{{ __('footer.branches') }}</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-gold-200">{{ __('footer.contact') }}</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-gold-200 font-medium">{{ __('footer.become_member') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-ink-700/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-ink-100/50">&copy; {{ date('Y') }} Kang Ming Acupuncture Centre. {{ __('footer.rights') }}</p>
            <p class="text-xs text-ink-100/40">{{ __('footer.crafted') }}</p>
        </div>
    </div>
</footer>
