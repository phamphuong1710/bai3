@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('success_update'))
<div class="alert alert-success">
    {{ session('success_update') }}
</div>
@endif
<div class="slider-section">
    <div class="table-users table-slider">
        <h1 class="page-title header">Slider</h1>
        <a href="/slider/create" class="create">{{ __('messages.create_slider') }}</a>

        <table cellspacing="0">
            <thead>
                <tr>
                    <th>
                        {{ __('messages.image') }}
                    </th>
                    <th>
                        {{ __('messages.description') }}
                    </th>

                    <th>
                        {{ __('messages.created_at') }}

                    </th>
                    <th>{{ __('messages.action') }} </th>
                </tr>

                @foreach( $slider as $slide )
                <tr>

                    <td><img src="{{ url('/').$slide->media->image_path }}" alt=""></td>
                    <td>{{ $slide->description }}</td>
                    <td>{{ $slide->created_at }}</td>
                    <td>
                        <a href="/slider/{{ $slide->id }}/edit" class="btn-action btn-edit"  data-id="{{ $slide->id }}" controller="slider">{{ __('messages.edit') }}</a>
                        <form action="/slider/{{ $slide->id }}" method="POST" class="form-delete">
                            @method('delete')
                            {{ csrf_field() }}
                            <button type="submit" class="btn-action btn-delete">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach

        </table>
        <div class="pagination">
            {{ $slider->links() }}
        </div>
        <div class="edit-popup-overlay" id="edit-popup">
            <div class="edit-popup" data-edit="users">
                <div class="edit-popup-wrapper edit-user">

                </div>
                <span class="btn-close-popup fa fa-close"></span>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/filter-user.js') }}"></script>
<!-- <script src="{{ asset('js/admin/edit-popup.js') }}"></script> -->
@endsection
