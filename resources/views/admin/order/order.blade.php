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
        <div class="order-action">

            <div class="action-bottom d-flex justify-content-between align-items-center">
                <div class="form-search search-order">
                    <input type="search" name="order" id="input-order" placeholder="Search User">
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
                        {{ __('messages.total') }}
                        <i class="fa fa-caret-down sorting desc" data-sort="email"></i>
                    </th>
                    <th>
                        {{ __('messages.created_at') }}
                        <i class="fa fa-caret-down sorting desc"  data-sort="created_at"></i>
                    </th>
                    <th>
                        {{ __('messages.status') }}
                        <i class="fa fa-caret-down sorting desc" data-sort="phone"></i>
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
