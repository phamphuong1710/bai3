@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('sidebar')
<li class="header">Dashboard</li>
<!-- Optionally, you can add icons to the links -->
<li><a href="/posts"><i class="fa fa-link"></i> <span>Post</span></a></li>
<li class="active"><a href="{{ url('/users') }}"><i class="fa fa-user"></i><span>User</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>
<ul class="treeview-menu">
    <li><a href="#">Link in level 2</a></li>
    <li><a href="#">Link in level 2</a></li>
</ul>
</li>
@endsection
@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Create Store') }}</div>
            <div class="card-body">
                <form method="POST" action="/stores/{{ $store->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="">{{ __('Name') }}</label>
                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus value="{{ $store->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class=" col-form-label text-md-right">{{ __('Phone') }}</label>
                        <div class="">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" autofocus value="{{ $store->phone }}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class=" col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus value="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class=" col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus value="{{ $store->description }}">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div id="preview-mode">
                        <ul id="image-preview" class="gallery-image-list">
                            @foreach( $store->media as $key => $image )
                            <li data-item="{{ $image->id }}" class="image-item">
                                <div class="image-wrapper">
                                    <div class="preview-action">
                                        <span val="{{ $key + 1 }}" class="image-position" >{{ $key + 1 }}</span>
                                        <a href="#" class="action-delete-image fa fa-times" data-id="{{ $image->id }}"></a>
                                        <span class="action-update-image  fa fa-undo" >
                                            <input type="file" class="input-update" name="image" data-id="{{ $image->id }}">
                                        </span>
                                    </div>
                                    @if( $image->video_path === NULL )
                                    <div class="image">
                                        <img src="{{ url('/').$image->image_path }}">
                                    </div>
                                    @endif
                                    @if( $image->video_path !== NULL )
                                    <div class="image image-video">
                                        <img src="{{ url('/').$image->image_path }}">
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <div class="custom d-flex">
                            <div class="input-file">
                                <label for="postImage">Image</label>
                                <input type="file" class="custom-file-input" id="postImage" lang="in" multiple="multiple" name='image[]'>
                                <input type="hidden" name="list_image" value="" id="listImage">
                            </div>
                            <button type="button" class="btn-video">Video</button>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
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
@endsection
