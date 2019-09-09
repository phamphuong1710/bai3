<div class="form-edit-user">

    <div class="form-edit-wrapper">
        <div class="card-header">
            <span class="header-text">
                {{ __('messages.edit') }}
            </span>
            <span class="ion-android-close btn-close-popup"></span>
        </div>
        <div class="card-body">
            <form method="POST" action="/users/{{ $user->id }}" class="form-edit-user">
                @method('PUT')
                @csrf
                <div class="avatar-content">
                    <div class="avatar-wrapper d-flex justify-content-center">
                        @if ( !empty($user->avatar) )
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" id="avatar">
                        @else
                            <img src="{{ asset('images/user-placeholder.jpg') }}" alt="{{ $user->name }}" id="avatar">
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="custom d-flex justify-content-center">
                            <div class="input-file">
                                <label for="logo">{{ __('messages.change') }}</label>
                                <input type="file" class="custom-file-input" id="logo" value="{{ $user->id }}" name='avatar'>
                                <input type="hidden" name="logo_id" class="id-logo" value="{{ $user->logo_id }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('messages.phone') }}</label>
                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        {{ __('messages.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
