@extends('layouts.app')
@section('title', __('admin.services.edit_title', ['name' => $service->localized('name')]))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('admin.services.edit_title', ['name' => $service->localized('name')]) }}</h1>
<div class="card p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @method('PUT')
        @include('admin.services._form')
    </form>
</div>
@endsection
