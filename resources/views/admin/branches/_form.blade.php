@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <input name="name" value="{{ old('name', $branch->name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <input name="name_zh_CN" value="{{ old('name_zh_CN', $branch->name_zh_CN ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <input name="name_zh_TW" value="{{ old('name_zh_TW', $branch->name_zh_TW ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.code') }}</label>
        <input name="code" value="{{ old('code', $branch->code ?? '') }}" required class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.address') }}</label>
        <textarea name="address" rows="2" class="input">{{ old('address', $branch->address ?? '') }}</textarea>
    </div>
    <div>
        <label class="label">{{ __('admin.common.phone') }}</label>
        <input name="phone" value="{{ old('phone', $branch->phone ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.email') }}</label>
        <input type="email" name="email" value="{{ old('email', $branch->email ?? '') }}" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.branches.col_in_charge') }}</label>
        <select name="teacher_in_charge_id" class="input">
            <option value="">{{ __('admin.common.none_option') }}</option>
            @foreach ($teachers as $t)
                <option value="{{ $t->id }}" {{ (int)old('teacher_in_charge_id', $branch->teacher_in_charge_id ?? 0) === $t->id ? 'selected' : '' }}>{{ $t->name }} ({{ $t->email }})</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300">
            {{ __('admin.common.active') }}
        </label>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
