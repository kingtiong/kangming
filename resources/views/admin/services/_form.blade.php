@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <input name="name" value="{{ old('name', $service->name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <input name="name_zh_CN" value="{{ old('name_zh_CN', $service->name_zh_CN ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <input name="name_zh_TW" value="{{ old('name_zh_TW', $service->name_zh_TW ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.services.slug') }}</label>
        <input name="slug" value="{{ old('slug', $service->slug ?? '') }}" placeholder="{{ __('admin.services.slug_placeholder') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.services.col_category') }}</label>
        <select name="category" class="input">
            @foreach (['treatment', 'class', 'consultation', 'other'] as $c)
                <option value="{{ $c }}" {{ old('category', $service->category ?? 'treatment') === $c ? 'selected' : '' }}>{{ __('admin.services.category_options.' . $c) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.audience') }}</label>
        <select name="audience" class="input">
            @foreach (['client', 'student', 'both'] as $a)
                <option value="{{ $a }}" {{ old('audience', $service->audience ?? 'client') === $a ? 'selected' : '' }}>{{ __('admin.services.audience_options.' . $a) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.services.duration_minutes') }}</label>
        <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes ?? 60) }}" min="5" max="600" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.services.default_price') }}</label>
        <input type="number" step="0.01" name="default_price" value="{{ old('default_price', $service->default_price ?? '0.00') }}" min="0" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <textarea name="description" rows="3" class="input">{{ old('description', $service->description ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <textarea name="description_zh_CN" rows="3" class="input">{{ old('description_zh_CN', $service->description_zh_CN ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <textarea name="description_zh_TW" rows="3" class="input">{{ old('description_zh_TW', $service->description_zh_TW ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300">
            {{ __('admin.common.active') }}
        </label>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
