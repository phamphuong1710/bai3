@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/store.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/library-image.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="store-section">
    <h2>{{ __('messages.notification') }}</h2>
        <table cellspacing="0" style="width: 100%">
            <thead>
                <tr>
                    <th>
                        {{ __('messages.name') }}
                    </th>
                    <th>
                        {{ __('messages.created_at') }}
                    </th>
                    <th>
                        {{ __('messages.type') }}
                    </th>
                    <th>
                        {{ __('messages.status') }}
                    </th>

                </tr>
            </thead>
            <tbody class="ajax-search-html">
                @foreach( $listNote as $notify )

                <tr>
                    <td><a href="/note/{{ $notify->id }}">{{ $notify->notifiable_id . '-' . $notify->custommer->name }}</a></td>

                    <td>{{ ($notify->created_at)->diffForHumans() }}</td>
                    <td>{{ $notify->type }}</td>
                    <td>
                        @if( $notify->read_at )
                            {{ __('messages.read') }}
                        @else
                            {{ __('messages.unread') }}
                        @endif
                    </td>
                    <td>

                        <a href="/note/{{ $notify->id }}" class="btn-action btn-show-notify btn-edit">{{ __( 'messages.show' ) }}</a>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection

