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

    <h1 class="page-title header">{{ __('messages.category') }}</h1>
    <a href="/categories/create" class="create">{{ __('messages.create_category') }}</a>
       <table cellspacing="0">
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('Slug') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>

            @foreach( $categories as $category )
              <tr>

                 <td><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></td>
                 <td>{{ $category->slug }}</td>

                 <td>
                     <a href="/categories/{{ $category->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                     <form action="/categories/{{ $category->id }}" method="POST" class="form-delete">
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
