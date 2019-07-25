@extends('admin.master')
@section('style')
  <link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="user-section">

  <div class="shop-detail">
    <h1 class="page-title header">{{ $store->name }}</h1>
    <a href="/products/create" class="create">{{ __('messages.createproduct') }}</a>
  </div>
</div>
@endsection
