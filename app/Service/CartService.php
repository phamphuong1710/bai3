<?php
namespace App\Service;

use App\InterfaceService\CartInterface;
use App\Cart;
use App\Product;
use App\CartDetail;
use App\User;
use Auth;

class CartService implements CartInterface
{
    protected $cartModel;
    protected $productModel;
    protected $cartDetailModel;
    protected $userModel;

    public function __construct(Cart $cartModel, Product $productModel, CartDetail $cartDetailModel, User $userModel)
    {
        $this->cartModel = $cartModel;
        $this->productModel = $productModel;
        $this->cartDetailModel = $cartDetailModel;
        $this->userModel = $userModel;
    }
    public function createCart($userId)
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

    public function createCartDetail($cartId, $productId, $quantity)
    {
        $cart = New CartDetail();
        $product = $this->productModel->find($productId);
        $cart->cart_id = $cartId;
        $cart->product_id = $productId;
        $cart->quantity = $quantity;
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
        $cart = $this->cartModel->find($cartId);
        $details = $this->cartDetailModel->where('cart_id', $cartId)
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
    public function updateCartDetail($cartId, $productId, $quantity)
    {
        $cartDetail = $this->cartDetailModel->where( 'cart_id', $cartId )
            ->where('product_id', $productId)
            ->first();
        $oldQuantity = $cartDetail->quantity;
        $quantity = $oldQuantity + $quantity;
        $cartDetail->quantity = $quantity;
        $cartDetail->save();

        return $cartDetail;
    }

    public function getCartByUser($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        return $cart;
    }

    public function deleteCartDetail($id)
    {
        $cartDetail = $this->cartDetailModel->find($id);
        $cartId = $cartDetail->cart_id;
        $cart = $this->cartModel->find($cartId);
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
        $this->cartDetailModel->Destroy($id);

        return $cartDetail;
    }


    // When Click button update cart page
    public function updateDetail($id, $quantity)
    {
        $cartDetail = $this->cartDetailModel->find($id);
        $cartDetail->quantity = $quantity;
        $cartDetail->save();

        return $cartDetail;
    }

    public function deleteCart($cartId)
    {
        $cartDetails = $this->cartDetailModel->where('cart_id', $cartId)
            ->get();
        $cart = $this->cartModel->findOrFail($cartId);
        if(!$cart) abort('404');
        $this->cartModel->Destroy($cartId);
        foreach ($cartDetails as $detail) {
            $this->cartDetailModel->Destroy($detail->id);
        }

        return $cart;
    }
}

