<?php
namespace App\Service;

use App\InterfaceService\CartInterface;
use App\Cart;
use App\Product;
use App\CartDetail;
use App\Order;
use App\OrderDetail;
use App\User;
use App\Address;
use Auth;

class CartService implements CartInterface
{
    public function createCart($request, $userId)
    {
        $cart = New Cart();
        $cart->user_id = $userId;
        $cart->usd = 0;
        $cart->vnd = 0;
        $cart->discount_usd = 0;
        $cart->discount_vnd = 0;
        $cart->quantity = 0;
        $cart->save();

        return $cart;
    }

    public function createCartDetail($cartId, $request)
    {
        $cart = New CartDetail();
        $productId = (int)$request->product_id;
        $product = Product::find($productId);
        $cart->cart_id = $cartId;
        $cart->product_id = $productId;
        $cart->quantity = $request->quantity;
        $discountUsd = $product->usd * ($product->on_sale )/100;
        $discountVnd = $product->vnd * ($product->on_sale )/100;
        $cart->usd = $product->usd;
        $cart->vnd = $product->vnd;
        $cart->discount_usd = formatNumber($discountUsd, 2);
        $cart->discount_vnd = formatNumber($discountVnd, 2);
        $cart->save();

        return $cart;
    }

    public function updateCart($cartId)
    {
        $cart = Cart::find($cartId);
        $details = CartDetail::where('cart_id', $cartId)
            ->get();
        $quantity = 0;
        $vnd = 0;
        $usd = 0;
        $discountVnd = 0;
        $discountUsd = 0;
        foreach ($details as $detail) {
            $quantity = $quantity + $detail->quantity;
            $vnd = $vnd + $detail->vnd * $detail->quantity;
            $usd = $usd + $detail->usd * $detail->quantity;
            $discountVnd = $discountVnd + $detail->discount_vnd * $detail->quantity;
            $discountUsd = $discountUsd + $detail->discount_usd * $detail->quantity;
        }
        $cart->quantity = $quantity;
        $cart->vnd = $vnd;
        $cart->usd = $usd;
        $cart->discount_usd = $discountUsd;
        $cart->discount_vnd = $discountVnd;
        $cart->save();

        return $cart;
    }

    // When click add to cart button
    public function updateCartDetail($cartId, $request)
    {
        $productId = (int)$request->product_id;
        $cartDetail = CartDetail::where( 'cart_id', $cartId )
            ->where('product_id', $productId)
            ->first();
        $oldQuantity = $cartDetail->quantity;
        $quantity = $oldQuantity + (int)$request->quantity;
        $cartDetail->quantity = $quantity;
        $cartDetail->save();

        return $cartDetail;
    }

    public function getCartByUser()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        return $cart;
    }

    public function deleteCartDetail($id)
    {
        $cartDetail = CartDetail::find($id);
        $cartId = $cartDetail->cart_id;
        $cart = Cart::find($cartId);
        $quantity = $cartDetail->quantity;
        $usd = $quantity * $cartDetail->usd;
        $vnd = $quantity * $cartDetail->vnd;
        $discountVnd = $quantity * $cartDetail->discount_usd;
        $discountUsd = $quantity * $cartDetail->discount_usd;
        $cart->quantity = $cart->quantity - $quantity;
        $cart->vnd = $cart->vnd - $vnd;
        $cart->usd = $cart->usd - $usd;
        $cart->discount_usd = $cart->discount_usd - $discountUsd;
        $cart->discount_vnd = $cart->discount_vnd - $discountVnd;
        $cart->save();
        CartDetail::Destroy($id);

        return $cartDetail;
    }


    // When Click button update cart page
    public function updateDetail($id, $quantity)
    {
        $cartDetail = CartDetail::find($id);
        $cartDetail->quantity = $quantity;
        $cartDetail->save();

        return $cartDetail;
    }

    public function order($request, $userId)
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->vnd = $request->vnd;
        $order->usd = $request->usd;
        $order->quantity = $request->quantity;
        $order->save();

        return $order;
    }

    public function orderDetail($orderId, $userId)
    {
        $cart = Cart::where('user_id', $userId)
            ->first();
        $cartDetails = $cart->detail;
        $orderDetails = [];
        foreach ($cartDetails as $detail) {
            $order = new OrderDetail();
            $order->order_id = $orderId;
            $order->product_id = $detail->product_id;
            $order->quantity = $detail->quantity;
            $order->usd = $detail->usd;
            $order->vnd = $detail->vnd;
            $order->discount_usd = $detail->discount_usd;
            $order->discount_vnd = $detail->discount_vnd;
            $order->save();
            array_push( $orderDetails, $detail);
        }

        return $orderDetails;
    }

    public function deleteCart($cartId)
    {
        $cartDetails = CartDetail::where('cart_id', $cartId)
            ->get();
        $cart = Cart::findOrFail($cartId);
        if(!$cart) abort('404');
        Cart::Destroy($cartId);
        foreach ($cartDetails as $detail) {
            CartDetail::Destroy($detail->id);
        }

        return $cart;
    }

    public function updateUserInfo($userId, $request)
    {
        $user = User::findOrFail($userId);
        if(!$user) abort('404');
        $user->phone = $request->phone;
        $user->full_name = $request->name;
        return $user;
    }

    public function createUserAddress($userId, $request)
    {
        $address = new Address();
        $address->user_id = $userId;
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->active = 1;
        $address->save();
        $oldAddress = Address::where('user_id', $userId)
            ->get();
        foreach ($oldAddress as $address) {
            $addr = Address::findOrFail($address->id);
            $addr->active = 0;
        }

        return $address;
    }
}

