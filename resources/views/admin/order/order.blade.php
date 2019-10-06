@extends('admin.master')
@section('style')
<link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/edit-popup.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/order-popup.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="order-section">
    <div class="table-orders">
        <h1 class="page-title header">{{ __( 'messages.order' ) }}</h1>

        <table cellspacing="0">
            <thead>
                <tr>
                    <th>
                        {{ __('messages.name') }}
                    </th>
                    <th>
                        {{ __('messages.total') }}
                    </th>
                    <th>
                        {{ __('messages.created_at') }}
                    </th>
                    <th>
                        {{ __('messages.status') }}
                    </th>

                    <th>{{ __('messages.action') }} </th>
                </tr>
            </thead>
            <tbody class="ajax-search-html">
                @foreach( $orders as $order )
                <tr>
                    <td><a href="/users/{{ $order->id }}">{{ $order->user->name }}</a></td>
                    <td>
                        @if( 'en' == app()->getLocale() )
                            {{ '$' . $order->usd }}
                        @else
                            {{ 'đ' . $order->vnd }}
                        @endif
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->status }}</td>
                    <td>

                        <a href="/order/{{ $order->id }}" class="btn-action btn-show-order btn-edit">{{ __( 'messages.show' ) }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </div>
    <div class="order-detail" id="order-detail">
        <div id="order-detail-wrapper" class="order-detail-wrapper"></div>
        <span class="btn-close-popup fa fa-close"></span>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('js/admin/filter-user.js') }}"></script>
<script src="{{ asset('js/admin/order-detail.js') }}"></script>
@endsection
