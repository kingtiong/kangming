@extends('layouts.app')
@section('title', __('auth.login_title'))
@section('content')
@php
    $demoAccounts = [
        ['role' => __('auth.demo_role_admin'),   'email' => 'admin@kangming.local',   'color' => 'bg-rose-100 text-rose-800'],
        ['role' => __('auth.demo_role_teacher'), 'email' => 'chan@kangming.local',    'color' => 'bg-amber-100 text-amber-800'],
        ['role' => __('auth.demo_role_teacher'), 'email' => 'wong@kangming.local',    'color' => 'bg-amber-100 text-amber-800'],
        ['role' => __('auth.demo_role_student'), 'email' => 'student@kangming.local', 'color' => 'bg-sky-100 text-sky-800'],
        ['role' => __('auth.demo_role_client'),  'email' => 'client@kangming.local',  'color' => 'bg-emerald-100 text-emerald-800'],
    ];
@endphp
<div class="max-w-md mx-auto card p-8">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('auth.login_title') }}</h1>
    <p class="text-sm text-slate-500 mt-1">{{ __('auth.login_subtitle') }}</p>
    <form id="login-form" method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">{{ __('auth.email') }}</label>
            <input id="email-input" type="email" name="email" value="{{ old('email') }}" required autofocus class="input">
        </div>
        <div>
            <label class="label">{{ __('auth.password_label') }}</label>
            <input id="password-input" type="password" name="password" required class="input">
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" name="remember" class="rounded border-slate-300">
            {{ __('auth.remember_me') }}
        </label>
        <button class="btn btn-primary w-full justify-center">{{ __('auth.sign_in') }}</button>
    </form>

    <div class="mt-8 pt-6 border-t border-slate-200">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-slate-700">{{ __('auth.demo_heading') }}</h2>
            <span class="text-xs text-slate-500">{{ __('auth.demo_password_hint') }}</span>
        </div>
        <div class="space-y-2">
            @foreach ($demoAccounts as $acc)
                <button type="button"
                        data-email="{{ $acc['email'] }}"
                        class="demo-btn w-full flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 text-left hover:bg-slate-50 transition">
                    <div>
                        <div class="text-sm font-medium text-slate-900">{{ $acc['email'] }}</div>
                        <div class="text-xs text-slate-500">{{ __('auth.demo_sign_in_as', ['role' => $acc['role']]) }}</div>
                    </div>
                    <span class="badge {{ $acc['color'] }}">{{ $acc['role'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <p class="mt-6 text-center text-sm text-slate-500">
        {{ __('auth.new_here') }} <a href="{{ route('register') }}" class="text-emerald-600 font-medium">{{ __('auth.create_account') }}</a>
    </p>
</div>

<script>
    document.querySelectorAll('.demo-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('email-input').value = btn.dataset.email;
            document.getElementById('password-input').value = 'kangming123';
            document.getElementById('login-form').submit();
        });
    });
</script>
@endsection
