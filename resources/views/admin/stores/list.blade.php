@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="user-section">
    <div class="table-users">
        <h1 class="page-title header">{{ __('messages.store') }}</h1>
        <a href="/stores/create" class="create">{{ __('messages.create_store') }}</a>
        <table cellspacing="0">
            <tr>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.phone') }}</th>
                <th>{{ __('messages.address') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
            @foreach( $stores as $store )
            <tr>
                <td><img src="{{ getStoreLogoPath($store->id) }}" alt="Logos"></td>
                <td><a href="/stores/{{ $store->id }}">{{ $store->name }}</a></td>
                <td>{{ $store->phone }}</td>
                <td></td>
                <td>
                    <a href="/stores/{{ $store->id }}/edit" class="btn-action btn-edit">{{ __('messages.edit') }}</a>
                    <form action="/stores/{{ $store->id }}" method="POST" class="form-delete">
                        @method('delete')
                        {{ csrf_field() }}
                        <button type="submit" class="btn-action btn-delete">{{ __('messages.delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="pagination">
            {{ $stores->links() }}
        </div>
    </div>
</div>
@endsection
