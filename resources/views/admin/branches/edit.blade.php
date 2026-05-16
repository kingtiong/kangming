@extends('layouts.app')
@section('title', __('admin.branches.edit_title', ['name' => $branch->localized('name')]))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('admin.branches.edit_title', ['name' => $branch->localized('name')]) }}</h1>
<div class="card p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.branches.update', $branch) }}">
        @method('PUT')
        @include('admin.branches._form')
    </form>
</div>
@endsection
