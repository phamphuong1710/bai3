
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="product-order">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.image') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.price') }}</th>
                        <th>{{ __('messages.quantity') }}</th>
                        <th>{{ __('messages.total') }}</th>
                        <th>{{ __('messages.store') }}</th>
                        <th>{{ __('messages.address') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $orderDetail as $detail )
                    @php
                    $product = $detail->product;
                    @endphp
                    <tr class="cart-item">
                        <td class="product-image">
                            <div class="product-thumb">
                                <img src="{{ $product->logo }}" alt="{{ $product->name }}" class="product-logo">
                            </div>
                        </td>
                        <td class="product-name">{{ $product->name }}</td>
                        <td class="product-price">
                            @if( app()->getLocale() == 'en' )
                            <div class="info-product-price">
                                @if( $product->discount_usd != 0 )
                                    <span class="item_price">
                                        {{ '$'.($product->usd - ( $product->discount_usd )) }}
                                    </span>
                                    <del>{{ '$'.$product->usd }}</del>
                                @else
                                    <span class="item_price">
                                        {{ '$'.$product->usd }}
                                    </span>
                                @endif
                            </div>
                            @endif
                            @if( app()->getLocale() == 'vi' )
                            <div class="info-product-price">
                                @if( $product->on_sale != 0 )
                                    <span class="item_price">
                                        {{ 'đ'.($product->vnd - $product->discount_vnd) }}
                                    </span>
                                    <del>{{ 'đ' . $product->vnd }}</del>
                                @else
                                    <span class="item_price">
                                        {{ 'đ'.$product->vnd }}
                                    </span>
                                @endif
                            </div>
                            @endif
                        </td>
                        <td class="product-quantity">
                            {{ $product->quantity }}
                        </td>
                        <td>
                            @if( app()->getLocale() == 'en' )
                                {{ '$'.($product->quantity * ( $product->usd - $product->discount_usd) ) }}
                            @else
                                {{ 'đ'.($product->quantity * ( $product->vnd - $product->discount_vnd)) }}
                            @endif
                        </td>
                        <td class="order-store">
                            {{ $product->store->name }}
                        </td>
                        <td class="order-store-address">
                            {{ $product->store->address->address }}

                        </td>
                        <td class="product-item-action">
                            <span class="ion-close delete-product" product="{{ $product->id }}"></span>
                        </td>

                    </tr>
                    @endforeach
                    <tr class="cart-total">
                        <td class="total-label" colspan="6"> {{ __('messages.total') }}</td>
                        @php
                            if( app()->getLocale() == 'en' ) :
                                $price = ($order->usd - $order->discount_usd);
                            else :
                                $price = ($order->vnd - $order->discount_vnd);
                            endif
                        @endphp
                        <td class="total-price">
                                {{ '$'. $price }}
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="order-status">
            <span class="status">{{ $order->status }}</span>
        </div>
    </div>
</div>

