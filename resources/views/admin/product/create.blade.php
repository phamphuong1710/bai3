@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.createproduct') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/products') }}">
                        @csrf
                        <div class="logo-content">
                            <div class="logo-wrapper d-flex justify-content-center">
                                <img src="{{asset('images/logo-placeholder.png')}}" alt="Logo Placeholder">
                            </div>
                            <div class="form-group">
                                <div class="custom d-flex justify-content-center">
                                    <div class="input-file">
                                        <label for="logo">{{ __('messages.feature_image') }}</label>
                                        <input type="file" class="custom-file-input form-control @error('logo_id') is-invalid @enderror" id="logo" lang="in" name='logo'>
                                        @error('logo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <input type="hidden" name="logo_id" class="id-logo form-control">
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
                            <label for="category" class=" col-form-label text-md-right">{{ __('messages.category') }}</label>
                            <div class="">
                                <select class="form-control" id="category" name="category_id">
                                    @foreach( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class=" col-form-label text-md-right">{{ __('messages.price') }}</label>
                            <div class="">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price" autofocus>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_sale" class=" col-form-label text-md-right">{{ __('messages.price_sale') }}</label>
                            <div class="">
                                <input id="price_sale" type="number" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price" required autocomplete="price_sale" autofocus>
                                @error('sale_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class=" col-form-label text-md-right">{{ __('messages.quantity') }}</label>
                            <div class="">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required autocomplete="quantity" autofocus>
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
                            <div class="">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus>
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
                                <button type="button" class="btn-video">{{ __('Video') }}</button>
                            </div>
                            @error('list_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
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
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/admin/remove.js') }}"></script>
<script src="{{ asset('js/admin/create-logo.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>
<script src="{{ asset('js/admin/create-images.js') }}"></script>
<script src="{{ asset('js/admin/delete-image.js') }}"></script>
<script src="{{ asset('js/admin/edit-image.js') }}"></script>
<script src="{{ asset('js/admin/ui-sortable.js') }}"></script>
<script src="{{ asset('js/admin/video.js') }}"></script>
@endsection
