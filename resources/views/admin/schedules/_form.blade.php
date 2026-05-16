@csrf
<div class="grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="label">{{ __('teacher.col_section') }}</label>
        <select name="section_id" required class="input">
            @foreach ($sections as $s)
                <option value="{{ $s->id }}" {{ (int)old('section_id', $schedule->section_id ?? 0) === $s->id ? 'selected' : '' }}>
                    {{ $s->localized('name') }} · {{ $s->service?->localized('name') }} · {{ $s->branch?->localized('name') }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.schedules.starts_at') }}</label>
        <input type="datetime-local" name="starts_at" value="{{ old('starts_at', optional($schedule->starts_at ?? null)->format('Y-m-d\TH:i')) }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.schedules.ends_at') }}</label>
        <input type="datetime-local" name="ends_at" value="{{ old('ends_at', optional($schedule->ends_at ?? null)->format('Y-m-d\TH:i')) }}" required class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.schedules.teacher_override') }}</label>
        <select name="teacher_id" class="input">
            <option value="">{{ __('admin.schedules.use_section_teacher') }}</option>
            @foreach ($teachers as $t)
                <option value="{{ $t->id }}" {{ (int)old('teacher_id', $schedule->teacher_id ?? 0) === $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">{{ __('admin.schedules.room') }}</label>
        <input name="room" value="{{ old('room', $schedule->room ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.schedules.capacity_override') }}</label>
        <input type="number" name="capacity" value="{{ old('capacity', $schedule->capacity ?? '') }}" min="1" class="input">
    </div>
    <div>
        <label class="label">{{ __('admin.common.status') }}</label>
        <select name="status" class="input">
            @foreach (['scheduled', 'cancelled', 'completed'] as $st)
                <option value="{{ $st }}" {{ old('status', $schedule->status ?? 'scheduled') === $st ? 'selected' : '' }}>{{ __('admin.schedules.status_options.' . $st) }}</option>
            @endforeach
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="label">{{ __('admin.common.notes') }}</label>
        <textarea name="notes" rows="2" class="input">{{ old('notes', $schedule->notes ?? '') }}</textarea>
    </div>
</div>
<div class="mt-6 flex gap-3">
    <button class="btn btn-primary">{{ __('admin.common.save') }}</button>
    <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline">{{ __('admin.common.cancel') }}</a>
</div>
