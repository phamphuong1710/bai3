
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="header-text">
                    {{ __('messages.edit') }}
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('products.update', ['id' => $product->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="logo-content">
                        <div class="logo-wrapper d-flex justify-content-center">
                            <img src="{{ $product->logo }}" alt="Logo Placeholder" data-id="{{ $product->logo_id }}">
                        </div>
                        <div class="form-group">
                            <div class="custom d-flex justify-content-center">
                                <div class="input-file">
                                    <label for="logo">{{ __('messages.change') }}</label>
                                    <input type="file" class="custom-file-input" id="logo" lang="in" name='logo'>
                                    <input type="hidden" name="logo_id" class="id-logo" value="{{ $product->logo_id }}">
                                </div>
                                <button type="button" class="btn-delete-logo">{{ __('messages.delete') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="">{{ __('messages.name') }}</label>
                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus value="{{ $product->name }}">
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
                                <option value="{{ $product->category_id }}">
                                    {{ $product->category->name }}
                                </option>

                                @foreach( $product->categories as $category )

                                    @if( $product->category_id != $category->id)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if( app()->getLocale() == 'en' )
                    <div class="form-group">
                        <label for="price" class=" col-form-label text-md-right">{{ __('messages.price') }}</label>
                        <div class="">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price" autofocus value="{{ $product->in_price_usd }}">
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
                            <input id="price_sale" type="number" class="form-control @error('price_sale') is-invalid @enderror" name="sale_price" required autocomplete="price_sale" autofocus value="{{ $product->usd }}">
                            @error('price_sale')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @endif

                    @if( app()->getLocale() == 'vi' )
                    <div class="form-group">
                        <label for="price" class=" col-form-label text-md-right">{{ __('messages.price') }}</label>
                        <div class="">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price" autofocus value="{{ $product->in_price_vnd }}">
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
                            <input id="price_sale" type="number" class="form-control @error('price_sale') is-invalid @enderror" name="sale_price" required autocomplete="price_sale" autofocus value="{{ $product->vnd }}">
                            @error('price_sale')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @endif
                    <div class="form-group">
                        <label for="on-sale" class=" col-form-label text-md-right">{{ __('messages.on_sale') }}</label>
                        <div class="">
                            <input id="on-sale" type="text" class="form-control @error('on_sale') is-invalid @enderror" name="on_sale" autocomplete="on-sale" autofocus value="{{ $product->on_sale }}">
                        </div>
                        @error('on_sale')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity" class=" col-form-label text-md-right">{{ __('messages.quantity') }}</label>
                        <div class="">
                            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required autocomplete="quantity" autofocus value="{{ $product->quantity_stock }}">
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
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus value="{{ $product->description }}">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div id="preview-mode">
                        <ul id="image-preview" class="gallery-image-list">
                            @foreach( $product->media->where('active', 0) as $key => $image )
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
                                <input type="hidden" name="list_image" value="{{ $product->list_image }}" id="listImage">
                            </div>
                            <button class="btn btn-image-library">{{ __('messages.library_image') }}</button>
                            <button type="button" class="btn-video">{{ __('Video') }}</button>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="usd_to_vnd"  class="usd-to-vnd">

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
