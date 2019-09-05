@extends('admin.master')
@section('style')

<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.createproduct') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/slider') }}">
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
                            <label for="store" class=" col-form-label text-md-right">{{ __('messages.store') }}</label>
                            <div class="">
                                <select class="form-control" id="store" name="store_id">
                                    @foreach( $stores as $store )
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
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

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <button type="submit" class="btn btn-primary">
                        {{ __('messages.create') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{ asset('js/admin/slider-image.js') }}"></script>
<script src="{{ asset('js/admin/delete-logo.js') }}"></script>

@endsection
