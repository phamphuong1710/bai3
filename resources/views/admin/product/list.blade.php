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
<div class="user-section">
<div class="table-users">
    <h1 class="page-title header">Stores</h1>
    <a href="/stores/create" class="create">Create New Store</a>
    <table cellspacing="0">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        @foreach( $stores as $store )
        <tr>
            <td></td>
            <td><a href="/stores/{{ $store->id }}">{{ $store->name }}</a></td>
            <td>{{ $store->phone }}</td>
            <td></td>
            <td>
                <a href="/stores/{{ $store->id }}/edit" class="btn-action btn-edit">Edit</a>
                <form action="/stores/{{ $store->id }}" method="POST" class="form-delete">
                    @method('delete')
                    {{ csrf_field() }}
                    <button type="submit" class="btn-action btn-delete">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>
@endsection
