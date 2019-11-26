@extends('admin.master')
@section('style')

<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('messages.create_category') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ url('/categories') }}">
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
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @error('slug')
                    <div class="form-group row">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    <div class="form-group row">
                        <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.parent_category') }}</label>
                        <div class="col-md-6">
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="0">
                                        {{ __('messages.select_parent_category') }}
                                    </option>
                                    @foreach( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @error('slug')
                    <div class="form-group row">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
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
@endsection
