@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <input name="name" value="{{ old('name', $section->name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <input name="name_zh_CN" value="{{ old('name_zh_CN', $section->name_zh_CN ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.name') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <input name="name_zh_TW" value="{{ old('name_zh_TW', $section->name_zh_TW ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.code') }}</label>
        <input name="code" value="{{ old('code', $section->code ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.service') }}</label>
        <select name="service_id" required class="input">
            @foreach ($services as $s)
                <option value="{{ $s->id }}" {{ (int)old('service_id', $section->service_id ?? 0) === $s->id ? 'selected' : '' }}>{{ $s->localized('name') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.branch') }}</label>
        <select name="branch_id" required class="input">
            @foreach ($branches as $b)
                <option value="{{ $b->id }}" {{ (int)old('branch_id', $section->branch_id ?? 0) === $b->id ? 'selected' : '' }}>{{ $b->localized('name') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.teacher') }}</label>
        <select name="teacher_id" class="input">
            <option value="">{{ __('admin.common.none_option') }}</option>
            @foreach ($teachers as $t)
                <option value="{{ $t->id }}" {{ (int)old('teacher_id', $section->teacher_id ?? 0) === $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.audience') }}</label>
        <select name="audience" class="input">
            @foreach (['client', 'student', 'both'] as $a)
                <option value="{{ $a }}" {{ old('audience', $section->audience ?? 'student') === $a ? 'selected' : '' }}>{{ __('admin.services.audience_options.' . $a) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.common.capacity') }}</label>
        <input type="number" name="capacity" value="{{ old('capacity', $section->capacity ?? 10) }}" min="1" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.status') }}</label>
        <select name="status" class="input">
            @foreach (['draft', 'open', 'closed', 'completed'] as $s)
                <option value="{{ $s }}" {{ old('status', $section->status ?? 'open') === $s ? 'selected' : '' }}>{{ __('admin.sections.status_options.' . $s) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.sections.starts_on') }}</label>
        <input type="date" name="starts_on" value="{{ old('starts_on', optional($section->starts_on ?? null)->format('Y-m-d')) }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.sections.ends_on') }}</label>
        <input type="date" name="ends_on" value="{{ old('ends_on', optional($section->ends_on ?? null)->format('Y-m-d')) }}" class="input">
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(EN · default / fallback)</span></label>
        <textarea name="description" rows="3" class="input">{{ old('description', $section->description ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(简体中文)</span></label>
        <textarea name="description_zh_CN" rows="3" class="input">{{ old('description_zh_CN', $section->description_zh_CN ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.description') }} <span class="text-xs text-slate-400">(繁體中文)</span></label>
        <textarea name="description_zh_TW" rows="3" class="input">{{ old('description_zh_TW', $section->description_zh_TW ?? '') }}</textarea>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.sections.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
