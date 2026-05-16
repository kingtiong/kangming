@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <label class="label">{{ __('admin.common.name') }}</label>
        <input name="name" value="{{ old('name', $user->name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.email') }}</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.phone') }}</label>
        <input name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.users.role') }}</label>
        <select name="role" required class="input">
            @foreach (\App\Models\User::ROLES as $k => $v)
                <option value="{{ $k }}" {{ old('role', $user->role ?? 'client') === $k ? 'selected' : '' }}>{{ __('common.roles.' . $k) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.branch') }}</label>
        <select name="branch_id" class="input">
            <option value="">{{ __('admin.common.none_option') }}</option>
            @foreach ($branches as $b)
                <option value="{{ $b->id }}" {{ (int)old('branch_id', $user->branch_id ?? 0) === $b->id ? 'selected' : '' }}>{{ $b->localized('name') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.users.date_of_birth') }}</label>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', optional($user->date_of_birth ?? null)->format('Y-m-d')) }}" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.notes') }}</label>
        <textarea name="notes" rows="2" class="input">{{ old('notes', $user->notes ?? '') }}</textarea>
    </div>
    <div>
        <label class="label">{{ __('admin.users.password') }} {{ isset($user) ? __('admin.users.password_keep_hint') : '' }}</label>
        <input type="password" name="password" {{ isset($user) ? '' : 'required' }} minlength="8" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300">
            {{ __('admin.common.active') }}
        </label>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
