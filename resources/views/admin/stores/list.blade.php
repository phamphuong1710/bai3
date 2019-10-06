@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/store.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
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
            <div class="action-bottom d-flex justify-content-between align-items-center">
                <span class="count-store">
                    {{ count($stores).' '.__('messages.store') }}
                </span>
                <div class="form-filter d-flex justify-content-between align-items-center">

                    <div class="form-group">
                        <select class="form-control" id="sorting" name="category">
                            <option value="created_at-asc">
                                {{ __('messages.sort_date_asc') }}</option>
                            <option value="name-asc">
                                {{ __('messages.sort_name_asc') }}
                            </option>
                            <option value="rating_average-asc">
                                {{ __('messages.sort_rating_asc') }}
                            </option>
                            <option value="name-desc">
                                {{ __('messages.sort_name_desc') }}
                            </option>
                            <option value="created_at-desc">
                                {{ __('messages.sort_date_desc') }}
                            </option>
                            <option value="rating_average-desc">
                                {{ __('messages.sort_rating_desc') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="album py-5 bg-light list-store">
            <div class="container">
                <div class="row ajax-search-html">
                    @foreach( $stores as $store )
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            @foreach( $store->media->where('active', 1) as $logo )
                            <img class="card-img-top" src="{{ $logo->image_path }}" alt="Card image cap">
                            @endforeach
                            <div class="card-body">
                                <h4 class="store-name">{{ $store->name }}</h4>
                                <span class="store-phone store-text">
                                    <span class="label">{{ __('messages.phone') }}: </span>
                                    {{ $store->phone }}
                                </span>
                                <span class="store-address store-text">
                                    <span class="label">{{ __('messages.address') }}: </span>
                                    {{ $store->address->address }}
                                </span>
                                <span class="store-description store-text">
                                    <span class="label">{{ __('messages.description') }}: </span>
                                    {{ $store->description }}
                                </span>
                                <div class="d-flex justify-content-between align-items-center btn-group" >
                                    <a href="/stores/{{ $store->id }}" class="btn-action btn-action btn-view">{{ __('messages.view') }}</a>
                                    <a href="/stores/{{ $store->id }}/edit" class="btn-action btn-edit"  data-id="{{ $store->id }}" controller="stores">{{ __('messages.edit') }}</a>
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
                    <div class="pagination">
                        {{ $stores->links() }}
                    </div>
                    <div class="edit-popup-overlay" id="edit-popup">
                        <div class="edit-popup" data-edit="stores">
                            <div class="edit-popup-wrapper edit-store">

                            </div>
                            <span class="btn-close-popup fa fa-close"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="library-image-wrapper">
    <div class="library-image-content">
        <ul id="image-library" class="list-old-image imageby-user">

        </ul>
        <div class="library-action">
            <div class="library-action-wrapper">
                <span class="btn btn-close">{{ __('messages.close') }}</span>
                <button class="btn btn-images-choose">{{ __('messages.insert') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/admin/remove.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&libraries=places&anguage=vi&region=VI" async defer></script>
<script src="{{ asset('js/admin/create-logo.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>
<script src="{{ asset('js/admin/create-images.js') }}"></script>
<script src="{{ asset('js/admin/delete-image.js') }}"></script>
<script src="{{ asset('js/admin/edit-image.js') }}"></script>
<script src="{{ asset('js/admin/delete-store.js') }}"></script>
<script src="{{ asset('js/admin/search-store.js') }}"></script>
<script src="{{ asset('js/admin/edit-popup.js') }}"></script>
@endsection
