@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.store') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/stores') }}">
                        @csrf
                        <div class="logo-content">
                            <div class="logo-wrapper d-flex justify-content-center">
                                <img src="{{asset('images/logo-placeholder.png')}}" alt="Logo Placeholder">
                            </div>
                            <div class="form-group">
                                <div class="custom d-flex justify-content-center">
                                    <div class="input-file">
                                        <label for="logo">{{ __('Logo') }}</label>
                                        <input type="file" class="custom-file-input" id="logo" lang="in" name='logo'>
                                        <input type="hidden" name="logo_id" class="id-logo">
                                    </div>
                                    <button type="button" class="btn-delete-logo">{{ __('messages.delete') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="">{{ __('messages.name') }}</label>
                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class=" col-form-label text-md-right">{{ __('messages.phone') }}</label>
                            <div class="">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class=" col-form-label text-md-right">{{ __('messages.address') }}</label>
                            <div class="">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="map"></div>
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
                            <div class="">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div id="preview-mode">
                            <ul id="image-preview" class="gallery-image-list">
                            </ul>
                        </div>
                        <div class="form-group">
                            <div class="custom d-flex">
                                <div class="input-file">
                                    <label for="postImage">{{ __('messages.image') }}</label>
                                    <input type="file" class="custom-file-input" id="postImage" lang="in" multiple="multiple" name='image[]'>
                                    <input type="hidden" name="list_image" value="" id="listImage">

                                </div>
                                <button class="btn btn-image-library">{{ __('messages.library_image') }}</button>
                                <button type="button" class="btn-video">Video</button>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('messages.create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="library-image-wrapper">
                <div class="library-image-content">
                    <ul id="image-library" class="list-old-image imageby-user">

                    </ul>
                    <div class="library-action">
                        <div class="library-action-wrapper">
                            <button class="btn btn-close">{{ __('messages.close') }}</button>
                            <button class="btn btn-images-choose">{{ __('messages.insert') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&libraries=places&anguage=vi&region=VI" async defer></script>
<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/admin/google-map.js') }}"></script>
<script src="{{ asset('js/admin/remove.js') }}"></script>
<script src="{{ asset('js/admin/create-images.js') }}"></script>
<script src="{{ asset('js/admin/create-logo.js') }}"></script>
<script src="{{ asset('js/admin/delete-image.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>
<script src="{{ asset('js/admin/edit-image.js') }}"></script>
<script src="{{ asset('js/admin/ui-sortable.js') }}"></script>
<script src="{{ asset('js/admin/video.js') }}"></script>
<script src="{{ asset('js/admin/image-library.js') }}"></script>
@endsection
