@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="categories-section">
    <div class="table-users">
        <h1 class="page-title header">{{ __('messages.category') }}</h1>
        <a href="/categories/create" class="create">{{ __('messages.create_category') }}</a>
        <div class="category-action">

            <div class="action-bottom d-flex justify-content-between align-items-center">
                <div class="form-search search-category">
                    <input type="search" name="category" id="input-category" placeholder="Search ">
                    <button type="submit" class="fa fa-search btn-search"></button>
                </div>
                <div class="form-filter d-flex justify-content-between align-items-center">

                    <div class="form-select">
                        <select class="form-control" id="sorting" name="sorting">
                            <option value="created_at-asc">
                                {{ __('messages.sort_date_asc') }}</option>
                            <option value="name-asc">
                                {{ __('messages.sort_name_asc') }}
                            </option>

                            <option value="name-desc">
                                {{ __('messages.sort_name_desc') }}
                            </option>
                            <option value="created_at-desc">
                                {{ __('messages.sort_date_desc') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table cellspacing="0">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('Slug') }}</th>
                    <th class="category-action action-column">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody class="ajax-search-html">
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
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/delete-category.js') }}"></script>
<script src="{{ asset('js/admin/filter-category.js') }}"></script>
@endsection
