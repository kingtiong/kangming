@extends('layouts.app')
@section('title', __('admin.charges.edit_title'))
@section('content')
<h1 class="text-2xl font-semibold text-slate-900 mb-6">{{ __('admin.charges.edit_title') }}</h1>
<div class="card p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.charges.update', $charge) }}">
        @method('PUT')
        @include('admin.charges._form')
    </form>
</div>
@endsection
