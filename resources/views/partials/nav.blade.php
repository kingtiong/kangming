@php $u = auth()->user(); @endphp
<nav x-data class="bg-white/95 backdrop-blur border-b border-gold-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ url('/img/logo.svg') }}" alt="{{ __('nav.brand') }}" class="h-12 w-12">
                    <div class="leading-tight">
                        <div class="font-display text-xl text-gold-700 font-semibold tracking-wide">{{ __('nav.brand') }}</div>
                        <div class="text-[10px] uppercase tracking-[0.2em] text-gold-600">{{ __('nav.tagline') }}</div>
                    </div>
                </a>
                @auth
                    <div class="hidden lg:flex items-center gap-1 border-l border-gold-100 pl-6 ml-2">
                        @if ($u->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.dashboard') }}</a>
                            <a href="{{ route('admin.branches.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.branches') }}</a>
                            <a href="{{ route('admin.services.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.services') }}</a>
                            <a href="{{ route('admin.charges.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.charges') }}</a>
                            <a href="{{ route('admin.sections.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.sections') }}</a>
                            <a href="{{ route('admin.schedules.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.schedules') }}</a>
                            <a href="{{ route('admin.users.index') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.members') }}</a>
                        @elseif ($u->isTeacher())
                            <a href="{{ route('teacher.dashboard') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.my_dashboard') }}</a>
                        @elseif ($u->isMember())
                            <a href="{{ route('member.dashboard') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.my_dashboard') }}</a>
                            <a href="{{ route('member.browse') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.book_session') }}</a>
                            <a href="{{ route('member.bookings') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.my_bookings') }}</a>
                        @endif
                    </div>
                @else
                    <div class="hidden lg:flex items-center gap-1 border-l border-gold-100 pl-6 ml-2">
                        <a href="{{ route('about') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.about') }}</a>
                        <a href="{{ route('founder') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.founder') }}</a>
                        <a href="{{ route('services') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.services') }}</a>
                        <a href="{{ route('branches') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.branches') }}</a>
                        <a href="{{ route('contact') }}" class="px-3 py-2 text-sm text-ink-700 hover:text-gold-700">{{ __('nav.contact') }}</a>
                    </div>
                @endauth
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-1.5 text-xs">
                    @foreach (['zh_CN', 'zh_TW', 'en'] as $code)
                        <a href="{{ route('locale.switch', $code) }}"
                           class="px-2 py-1 rounded {{ app()->getLocale() === $code ? 'bg-gold-100 text-gold-800 font-semibold' : 'text-ink-700 hover:text-gold-700' }}">
                            {{ __('common.languages.' . $code) }}
                        </a>
                    @endforeach
                </div>
                @auth
                    <div class="hidden sm:flex items-center gap-2 border-l border-gold-100 pl-3">
                        <span class="badge bg-gold-100 text-gold-800">{{ __('common.roles.' . $u->role) }}</span>
                        <span class="hidden md:inline text-sm text-ink-700">{{ $u->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="hidden lg:block">
                        @csrf
                        <button class="btn btn-outline text-xs">{{ __('nav.sign_out') }}</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex btn btn-outline">{{ __('nav.sign_in') }}</a>
                    <a href="{{ route('register') }}" class="hidden lg:inline-flex btn btn-primary">{{ __('nav.join') }}</a>
                @endauth

                {{-- Hamburger toggle (visible < lg) --}}
                <button type="button"
                        onclick="document.getElementById('mobile-nav').classList.toggle('hidden'); document.getElementById('icon-open').classList.toggle('hidden'); document.getElementById('icon-close').classList.toggle('hidden');"
                        class="lg:hidden inline-flex items-center justify-center h-10 w-10 rounded-lg text-ink-700 hover:bg-gold-50 hover:text-gold-700"
                        aria-label="Toggle menu">
                    <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile drawer --}}
    <div id="mobile-nav" class="hidden lg:hidden border-t border-gold-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
            @auth
                <div class="flex items-center gap-2 pb-3 mb-3 border-b border-gold-100">
                    <span class="badge bg-gold-100 text-gold-800">{{ __('common.roles.' . $u->role) }}</span>
                    <span class="text-sm text-ink-700">{{ $u->name }}</span>
                </div>
                <div class="grid gap-1">
                    @if ($u->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.dashboard') }}</a>
                        <a href="{{ route('admin.branches.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.branches') }}</a>
                        <a href="{{ route('admin.services.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.services') }}</a>
                        <a href="{{ route('admin.charges.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.charges') }}</a>
                        <a href="{{ route('admin.sections.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.sections') }}</a>
                        <a href="{{ route('admin.schedules.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.schedules') }}</a>
                        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.members') }}</a>
                    @elseif ($u->isTeacher())
                        <a href="{{ route('teacher.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.my_dashboard') }}</a>
                    @elseif ($u->isMember())
                        <a href="{{ route('member.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.my_dashboard') }}</a>
                        <a href="{{ route('member.browse') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.book_session') }}</a>
                        <a href="{{ route('member.bookings') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.my_bookings') }}</a>
                    @endif
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3 pt-3 border-t border-gold-100">
                    @csrf
                    <button class="w-full btn btn-outline justify-center">{{ __('nav.sign_out') }}</button>
                </form>
            @else
                <div class="grid gap-1 mb-3">
                    <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.about') }}</a>
                    <a href="{{ route('founder') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.founder') }}</a>
                    <a href="{{ route('services') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.services') }}</a>
                    <a href="{{ route('branches') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.branches') }}</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-lg text-sm text-ink-800 hover:bg-gold-50">{{ __('nav.contact') }}</a>
                </div>
                <div class="grid grid-cols-2 gap-2 pt-3 border-t border-gold-100">
                    <a href="{{ route('login') }}" class="btn btn-outline justify-center">{{ __('nav.sign_in') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary justify-center">{{ __('nav.join') }}</a>
                </div>
            @endauth

            <div class="mt-4 pt-3 border-t border-gold-100">
                <p class="text-[11px] uppercase tracking-wider text-gold-600 mb-2 px-1">{{ __('common.language') }}</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['zh_CN', 'zh_TW', 'en'] as $code)
                        <a href="{{ route('locale.switch', $code) }}"
                           class="text-center px-2 py-2 rounded-lg text-sm {{ app()->getLocale() === $code ? 'bg-gold-100 text-gold-800 font-semibold' : 'text-ink-700 hover:bg-gold-50' }}">
                            {{ __('common.languages.' . $code) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>
