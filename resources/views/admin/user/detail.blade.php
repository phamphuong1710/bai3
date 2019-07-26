@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="user-section">
    <a href="/users/{{ $user->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
    <h1 class="user-name">{{ $user->name }}</h1>
    <span>{{ $user->email }}</span>
</div>
@endsection
