@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <label class="label">{{ __('admin.common.service') }}</label>
        <select name="service_id" required class="input">
            @foreach ($services as $s)
                <option value="{{ $s->id }}" {{ (int)old('service_id', $charge->service_id ?? 0) === $s->id ? 'selected' : '' }}>{{ $s->localized('name') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.charges.branch_optional') }}</label>
        <select name="branch_id" class="input">
            <option value="">{{ __('admin.charges.all_branches') }}</option>
            @foreach ($branches as $b)
                <option value="{{ $b->id }}" {{ (int)old('branch_id', $charge->branch_id ?? 0) === $b->id ? 'selected' : '' }}>{{ $b->localized('name') }}</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.charges.label_field') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <input name="label" value="{{ old('label', $charge->label ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.col_label') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <input name="label_zh_CN" value="{{ old('label_zh_CN', $charge->label_zh_CN ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.col_label') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <input name="label_zh_TW" value="{{ old('label_zh_TW', $charge->label_zh_TW ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.audience') }}</label>
        <select name="audience" class="input">
            @foreach (['client', 'student', 'both'] as $a)
                <option value="{{ $a }}" {{ old('audience', $charge->audience ?? 'both') === $a ? 'selected' : '' }}>{{ __('admin.services.audience_options.' . $a) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.charges.currency') }}</label>
        <input name="currency" value="{{ old('currency', $charge->currency ?? 'MYR') }}" maxlength="3" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.amount') }}</label>
        <input type="number" step="0.01" name="amount" value="{{ old('amount', $charge->amount ?? '0.00') }}" min="0" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.session_count') }}</label>
        <input type="number" name="session_count" value="{{ old('session_count', $charge->session_count ?? 1) }}" min="1" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.valid_from') }}</label>
        <input type="date" name="valid_from" value="{{ old('valid_from', optional($charge->valid_from ?? null)->format('Y-m-d')) }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.charges.valid_to') }}</label>
        <input type="date" name="valid_to" value="{{ old('valid_to', optional($charge->valid_to ?? null)->format('Y-m-d')) }}" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.notes') }}</label>
        <textarea name="notes" rows="2" class="input">{{ old('notes', $charge->notes ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $charge->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300">
            {{ __('admin.common.active') }}
        </label>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.charges.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
