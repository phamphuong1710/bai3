@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <span class="price" price="100000">100000</span>
    <span class="price" price="2300000">2300000</span>
</div>
@endsection
@section('js')
@if( app()->getLocale() == 'en' )
<script src="{{ asset('js/admin/currency.js') }}"></script>
@endif
@endsection
