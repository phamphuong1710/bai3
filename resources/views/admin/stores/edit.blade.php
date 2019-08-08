
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="header-text">
                        {{ __('messages.edit') }}
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="/stores/{{ $store->id }}">
                        @csrf
                        @method('PUT')
                        <div class="logo-content">
                            <div class="logo-wrapper d-flex justify-content-center">
                                <img src="{{ $store->logo }}" alt="Logo Placeholder" data-id="{{ $store->logo_id }}">
                            </div>
                            <div class="form-group">
                                <div class="custom d-flex justify-content-center">
                                    <div class="input-file">
                                        <label for="logo">{{ __('messages.change') }}</label>
                                        <input type="file" class="custom-file-input" id="logo" lang="in" name='logo'>
                                        <input type="hidden" name="logo_id" class="id-logo" value="{{ $store->logo_id }}">
                                    </div>
                                    <button type="button" class="btn-delete-logo">{{ __('messages.delete') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="">{{ __('messages.name') }}</label>
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
                            <label for="phone" class=" col-form-label text-md-right">{{ __('messages.phone') }}</label>
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
                            <label for="address" class=" col-form-label text-md-right">{{ __('messages.address') }}</label>
                            <div class="">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus value="{{ $store->address->address }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div id="map"></div>
                                <input type="hidden" name="lat" id="lat" value="{{ $store->address->lat }}">
                                <input type="hidden" name="lng" id="lng" value="{{ $store->address->lng }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
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
                                    <label for="postImage">{{ __('messages.image') }}</label>
                                    <input type="file" class="custom-file-input" id="postImage" lang="in" multiple="multiple" name='image[]'>
                                    <input type="hidden" name="list_image" value="{{ getListImageStore($store->id) }}" id="listImage">
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

        </div>
    </div>
</div>
