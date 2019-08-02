@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/store.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="store-section">
    <div class="table-stores">
        <h1 class="page-title header">{{ __('messages.stores') }}</h1>
        <div class="store-action">
            <div class="action-top d-flex justify-content-between align-items-center">
                <a href="/stores/create" class="create create-store">
                    {{ __('messages.create_store') }}
                </a>
                <div class="form-search search-store">
                    <input type="search" name="store" id="input-store">
                    <button type="submit" class="fa fa-search btn-search"></button>
                </div>
            </div>
        </div>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach( $stores as $store )
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="{{ getStoreLogoPath($store->id) }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="store-name">{{ $store->name }}</h4>
                                <span class="store-phone store-text">
                                    <span class="label">{{ __('messages.phone') }}: </span>
                                    {{ $store->phone }}
                                </span>
                                <span class="store-address store-text">
                                    <span class="label">{{ __('messages.address') }}: </span>
                                    {{ getStoreAddress($store->id)->address }}
                                </span>
                                <span class="store-description store-text">
                                    <span class="label">{{ __('messages.description') }}: </span>
                                    {{ $store->description }}
                                </span>
                                <div class="d-flex justify-content-between align-items-center btn-group" >
                                    <a href="/stores/{{ $store->id }}" class="btn-action btn-action btn-view">{{ __('messages.view') }}</a>
                                    <a href="/stores/{{ $store->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                                    <form action="/stores/{{ $store->id }}" method="POST" class="form-delete">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn-action btn-delete btn-delete-store" data-id="{{ $store->id }}">{{ __('messages.delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="pagination">
            {{ $stores->links() }}
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/delete-store.js') }}"></script>
@endsection
