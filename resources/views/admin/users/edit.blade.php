@extends('layouts.app')
@section('title', __('admin.users.edit_title', ['name' => $user->name]))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('admin.users.edit_title', ['name' => $user->name]) }}</h1>
<div class="card p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form')
    </form>
</div>
@endsection
