@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="user-section">
<div class="table-users">
    <h1 class="page-title header">{{ __('messages.category') }}</h1>
    <a href="/categories/create" class="create">{{ __('messages.create_category') }}</a>
    <table cellspacing="0">
        <tr>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('Slug') }}</th>
            <th>{{ __('messages.action') }}</th>
        </tr>
        @foreach( $categories as $category )
        <tr data-id="{{ $category->id }}">
            <td><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></td>
            <td>{{ $category->slug }}</td>
            <td>
                <a href="/categories/{{ $category->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                <form action="/categories/{{ $category->id }}" method="POST" class="form-delete">
                    @method('delete')
                    {{ csrf_field() }}
                    <button type="submit" class="btn-action btn-delete btn-delete-cat" data-id="{{ $category->id }}">{{ __('messages.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/delete-category.js') }}"></script>
@endsection
