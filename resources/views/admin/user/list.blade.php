@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="user-section">
    <div class="table-users">
        <h1 class="page-title header">User</h1>
        <a href="/users/create" class="create">Create User</a>
        <div class="user-action">

            <div class="action-bottom d-flex justify-content-between align-items-center">
                <div class="form-search search-user">
                    <input type="search" name="user" id="input-user" placeholder="Search User">
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
                    <th>
                        {{ __('messages.name') }}
                        <i class="fa fa-caret-down sorting desc" data-sort="name"></i>
                    </th>
                    <th>
                        {{ __('messages.phone') }}
                        <i class="fa fa-caret-down sorting desc" data-sort="phone"></i>
                    </th>
                    <th>
                        Email
                        <i class="fa fa-caret-down sorting desc" data-sort="email"></i>
                    </th>
                    <th>
                        {{ __('messages.created_at') }}
                        <i class="fa fa-caret-down sorting desc"  data-sort="created_at"></i>
                    </th>
                    <th>{{ __('messages.action') }} </th>
                </tr>
            </thead>
            <tbody class="ajax-search-html">
                @foreach( $users as $user )
                <tr>
                    <td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="/users/{{ $user->id }}/edit" class="btn-action btn-edit"  data-id="{{ $user->id }}" controller="users">{{ __('messages.edit') }}</a>
                        <form action="/users/{{ $user->id }}" method="POST" class="form-delete">
                            @method('delete')
                            {{ csrf_field() }}
                            <button type="submit" class="btn-action btn-delete">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $users->links() }}
        </div>
        <div class="edit-popup edit-user" id="edit-popup" data-edit="users">
            <div class="edit-popup-wrapper height">

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/admin/filter-user.js') }}"></script>
<script src="{{ asset('js/admin/edit-popup.js') }}"></script>
@endsection
