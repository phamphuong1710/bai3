
<div class="row justify-content-center height">
    <div class="col-md-12 height">
        <div class="card height">
            <div class="card-header">
                <span class="header-text">
                    {{ __('messages.edit') }}
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="/categories/{{ $category->id }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.parent_category') }}</label>
                        <div class="col-md-6">
                                <select class="form-control" id="parent_id" name="parent_id">
                                    @if( $category->parent_id == 0 )
                                        <option value="0">
                                            {{ __('messages.select_parent_category') }}
                                        </option>
                                    @endif
                                    @foreach( $categories as $cat )

                                    @if( $cat->id !== $category->parent_id )
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            {{ __('messages.edit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

