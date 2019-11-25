<?php
namespace App\Service;

use App\InterfaceService\CartInterface;
use App\Cart;
use App\Product;
use App\CartDetail;
use App\User;
use Auth;
use Carbon\Carbon;

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

    public function createCart($userId, $storeId = null, $slug = false)
    {
        $time = Carbon::now()->timestamp;
        $text = str_random(5);
        $cart = New Cart();
        $cart->user_id = $userId;
        $cart->usd = 0;
        $cart->vnd = 0;
        $cart->discount_usd = 0;
        $cart->discount_vnd = 0;
        $cart->quantity = 0;
        if ( $slug ) {
            $cart->slug = $time . $text;
            $cart->store_id = $storeId;
        }
        $cart->save();

        return $cart;
    }

    public function createCartDetail($cartId, $productId, $quantity, $userId)
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
        $cart->user_id = $userId;
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

    public function addToCart($cart, $productId, $quantity, $userId, $slug = null)
    {
        if ( $slug ) {
            $cart = $this->groupAddToCart($cart, $productId, $quantity, $userId, $slug);
        } else {

            $cart = $this->nornalAddToCart($cart, $productId, $quantity, $userId);
        }

        return $cart;
    }

    public function nornalAddToCart($cart, $productId, $quantity, $userId)
    {
        if ( $cart ) {
            $cart = $this->getCart($cart);
            $products = $cart['product'];
            if ( array_key_exists($productId, $products) ) {
                $cartDetail = $this->updateCartDetail($cart['id'], $productId, $quantity);
            } else {
                $cartDetail = $this->createCartDetail($cart['id'], $productId, $quantity, $userId);
            }
            $currentCart = $this->updateCart($cart['id']);
            $product = $this->getProduct($cartDetail);
            session()->put('cart.vnd', $currentCart->vnd);
            session()->put('cart.usd', $currentCart->usd);
            session()->put('cart.discount_vnd', $currentCart->discount_vnd);
            session()->put('cart.discount_usd', $currentCart->discount_usd);
            session()->put('cart.quantity', $currentCart->quantity);
            session()->put('cart.product.' . $productId, $product);
        } else {
            $currentCart = $this->createCart($userId);
            $cartDetail = $this->createCartDetail($currentCart->id, $productId, $quantity, $userId);
            $currentCart = $this->updateCart($currentCart->id);
            $product = $this->getProduct($cartDetail);
            $data = [
                'id' => $currentCart->id,
                'vnd' => $currentCart->vnd,
                'usd' => $currentCart->usd,
                'user_id' => $userId,
                'quantity' => $currentCart->quantity,
                'discount_vnd' => $currentCart->discount_vnd,
                'discount_usd' => $currentCart->discount_usd,
                'product' => [
                    $cartDetail->id => $product,
                ]
            ];
            session()->put('cart', $data);
        }
        $cart = session()->get('cart');

        return $cart;
    }

    public function groupAddToCart($cart, $productId, $quantity, $userId, $slug)
    {
            $cart = $this->getCart($cart);
            $products = $cart['product'];
            $newProduct = $this->productModel->find($productId);
            if ( $cart->store_id == $newProduct->store ) {
                if ( array_key_exists($userId, $products) ) {
                    $item = $products[$userId];
                    if ( array_key_exists($productId, $item) ) {
                        $cartDetail = $this->updateCartDetail($cart['id'], $productId, $quantity);
                    } else {
                        $cartDetail = $this->createCartDetail($cart['id'], $productId, $quantity, $userId);
                    }
                } else {
                    $cartDetail = $this->createCartDetail($cart['id'], $productId, $quantity, $userId);
                }
                $currentCart = $this->updateCart($cart['id']);
                $product = $this->getProduct($cartDetail);
                session()->put('cart.vnd', $currentCart->vnd);
                session()->put('cart.usd', $currentCart->usd);
                session()->put('cart.discount_vnd', $currentCart->vnd);
                session()->put('cart.discount_usd', $currentCart->usd);
                session()->put('cart.quantity', $currentCart->quantity);
                session()->put('cart.product.' . $userId . '.' . $productId, $product);
            } else {
                abort('404');
            }



        $cart = session()->get('cart');

        return $cart;
    }

    public function getCart($cart)
    {
        session()->put('cart.id', $cart->id);
        session()->put('cart.vnd', $cart->vnd);
        session()->put('cart.usd', $cart->usd);
        session()->put('cart.quantity', $cart->quantity);
        session()->put('cart.discount_vnd', $cart->discount_vnd);
        session()->put('cart.discount_usd', $cart->discount_usd);
        session()->put('cart.store_id', $cart->store_id);
        session()->put('cart.slug', $cart->slug);
        $detail = $cart->detail;
        session()->put('cart.product', []);
        foreach ($detail as $item) {
            $productId = $item->product_id;
            $userId = $item->user_id;
            session()->put('cart.product.' . $userId, []);
            $product = $this->getProduct($item);
            if ( $product ) {
                if ( $cart->slug ) {
                    session()->put('cart.product.' . $userId . '.' . $productId, $product);
                } else {
                    session()->put('cart.product.' . $productId, $product);
                }
            }
        }
        $cart = session()->get('cart');

        return $cart;
    }

    public function getProduct($cartDetail)
    {
        $product = $cartDetail->product;
        $logo = $product->media->where('active', 1)->first();
        $cartDetail->logo = $logo->image_path;
        $cartDetail->name = $product->name;

        return $cartDetail;
    }

    public function getCartBySlug($slug)
    {
        $cart = $this->cartModel->where( 'slug', $slug )->firstOrFail();

        return $cart;
    }
}

