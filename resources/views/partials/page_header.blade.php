@props(['title', 'subtitle' => null, 'action' => null])
<div class="flex items-end justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">{{ $title }}</h1>
        @if ($subtitle)<p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>@endif
    </div>
    @if ($action){{ $action }}@endif
</div>
