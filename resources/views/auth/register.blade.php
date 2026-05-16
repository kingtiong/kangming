@extends('layouts.app')
@section('title', __('auth.register_title'))
@section('content')
<div class="max-w-lg mx-auto card p-8">
    <h1 class="text-2xl font-semibold text-slate-900">{{ __('auth.register_title') }}</h1>
    <p class="text-sm text-slate-500 mt-1">{{ __('auth.register_subtitle') }}</p>
    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="label">{{ __('auth.full_name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="input">
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="label">{{ __('auth.email') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="input">
            </div>
            <div>
                <label class="label">{{ __('auth.phone') }}</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="input">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="label">{{ __('auth.i_am_a') }}</label>
                <select name="role" required class="input">
                    <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>{{ __('auth.role_client') }}</option>
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>{{ __('auth.role_student') }}</option>
                </select>
            </div>
            <div>
                <label class="label">{{ __('auth.preferred_branch') }}</label>
                <select name="branch_id" class="input">
                    <option value="">{{ __('auth.any_branch') }}</option>
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}" {{ (int)old('branch_id') === $b->id ? 'selected' : '' }}>{{ $b->localized('name') }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="label">{{ __('auth.password_label') }}</label>
                <input type="password" name="password" required class="input" minlength="8">
            </div>
            <div>
                <label class="label">{{ __('auth.confirm_password') }}</label>
                <input type="password" name="password_confirmation" required class="input" minlength="8">
            </div>
        </div>
        <button class="btn btn-primary w-full justify-center">{{ __('auth.create_account_btn') }}</button>
    </form>
    <p class="mt-6 text-center text-sm text-slate-500">
        {{ __('auth.already_member') }} <a href="{{ route('login') }}" class="text-emerald-600 font-medium">{{ __('auth.sign_in') }}</a>
    </p>
</div>
@endsection
