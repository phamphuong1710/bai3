<?php
namespace App\Service;

use App\InterfaceService\CartInterface;
use App\Cart;
use App\Product;
use App\CartDetail;
use Auth;

class CartService implements CartInterface
{
    public function createCart($request)
    {
        $cart = New Cart();
        $productId = (int)$request->product_id;
        $product = Product::find($productId);
        $cart->user_id = Auth::id();
        $cart->quantity = $request->quantity;
        $cart->discount = 0;
        if (app()->getLocale() == 'en') {
            $cart->total_price = (int)$request->quantity * $product->usd;
            if ( $product->on_sale != 0 ) {
                $discount = $cart->total_price * ($product->on_sale/100 );
                $cart->discount = $discount;
            }
        } else {
            $cart->total_price = (int)$request->quantity * $product->vnd;
            if ( $product->on_sale != 0 ) {
                $discount = $cart->total_price * ($product->on_sale/100 );
                $cart->discount = $discount;
            }
        }
        $cart->save();

        return $cart;
    }

    public function createCartDetail($cartID, $request)
    {
        $cart = New CartDetail();
        $productId = (int)$request->product_id;
        $product = Product::find($productId);
        $cart->cart_id = $cartID;
        $cart->product_id = $productId;
        $cart->quantity = $request->quantity;
        $cart->discount = 0;
        if (app()->getLocale() == 'en') {
            $cart->unit_price = $product->usd;
            if ( $product->on_sale != 0 ) {
                $discount = ($product->on_sale )/100;
                $cart->discount = $discount;
            }
        } else {
            $cart->unit_price = $product->usd;
            if ( $product->on_sale != 0 ) {
                $discount = ($product->on_sale )/100;
                $cart->discount = $discount;
            }
        }
        $cart->save();

        return $cart;
    }

    public function updateCart($cartID, $request)
    {
        $cart = Cart::find($cartID);
        $productId = (int)$request->product_id;
        $product = Product::find($productId);
        $oldQty = $cart->quantity;
        $oldTotalPrice = $cart->total_price;
        $oldDiscount = $cart->discount;
        $cart->quantity = $oldQty + (int)$request->quantity;
        if (app()->getLocale() == 'en') {
            $price = (int)$request->quantity * $product->usd;
            $cart->total_price = $oldTotalPrice + $price;
            if ( $product->on_sale != 0 ) {
                $discount = $price * ($product->on_sale )/100;
                $cart->discount = $oldDiscount + $discount;
            }
        } else {
            $price = (int)$request->quantity * $product->vnd;
            $cart->total_price = $oldTotalPrice + $price;
            if ( $product->on_sale != 0 ) {
                $discount = $price * ($product->on_sale )/100;
                $cart->discount = $oldDiscount + $discount;
            }
        }
        $cart->save();

        return $cart;
    }
}

