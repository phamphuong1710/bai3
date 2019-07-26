@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="user-section">
    <div class="table-users">
        <h1 class="page-title header">User</h1>
        <a href="/users/create" class="create">Create User</a>
        <table cellspacing="0">
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.phone') }}</th>
                <th>Email</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
            @foreach( $users as $user )
            <tr>
                <td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="/users/{{ $user->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                    <form action="/users/{{ $user->id }}" method="POST" class="form-delete">
                        @method('delete')
                        {{ csrf_field() }}
                        <button type="submit" class="btn-action btn-delete">{{ __('messages.delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
