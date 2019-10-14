<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CartService;
use App\Http\Requests\CartRequest;
use App\Http\Requests\OrderRequest;
use Auth;
use Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct( CartService $cartService )
    {
        $this->cartService = $cartService;
    }

    public function cart()
    {
        session()->forget('cart');
        $userId = Auth::id();
        $cart = $this->cartService->getCartByUser($userId);
        if ( $cart ) {
            $cart = $this->getCart($cart);
        }

        return view('layouts.cart', compact('cart'));
    }

    public function addToCart(CartRequest $request)
    {
        $request->session()->forget('cart');
        $userId = Auth::id();
        $cart = $this->cartService->getCartByUser($userId);
        $productId = $request->product_id;
        $quantity = $request->quantity;
        if ( $cart ) {
            $cart = $this->getCart($cart);
            $products = $cart['product'];

            if ( array_key_exists($productId, $products) ) {
                $cartDetail = $this->cartService->updateCartDetail($cart['id'], $productId, $quantity);
            } else {
                $cartDetail = $this->cartService->createCartDetail($cart['id'], $productId, $quantity);
            }
            $currentCart = $this->cartService->updateCart($cart['id'], $request);
            $product = $this->getProduct($cartDetail);
            $request->session()->put('cart.product.' . $productId, $product);
        } else {
            $currentCart = $this->cartService->createCart($userId);
            $cartDetail = $this->cartService->createCartDetail($currentCart->id, $productId, $quantity);
            $currentCart = $this->cartService->updateCart($currentCart->id);
            $product = $this->getProduct($cartDetail);
            $data = [
                'id' => $currentCart->id,
                'vnd' => $currentCart->vnd,
                'usd' => $currentCart->usd,
                'quantity' => $currentCart->quantity,
                'discount_vnd' => $currentCart->discount_vnd,
                'discount_usd' => $currentCart->discount_usd,
                'product' => [
                    $cartDetail->id => $product,
                ]
            ];
            $request->session()->put('cart', $data);
        }
        $cart = $request->session()->get('cart');

        return response()->json($cart);
    }

    public function deleteCartDetail($id)
    {
        session()->forget('cart');
        $userId = Auth::id();
        $cartDetail = $this->cartService->deleteCartDetail($id);
        $cart = $this->cartService->getCartByUser($userId);

        return response()->json($cart);
    }

    public function updateCart(CartRequest $request, $id)
    {
        $listQuantity = $request->quantity;
        foreach ($listQuantity as $index => $quantity) {
            $cartDetail = $this->cartService->updateDetail($index,$quantity);
        }
        $cart = $this->cartService->updateCart($id);

        return response()->json($cart);
    }

    public function getCart($cart)
    {
        session()->put('cart.id', $cart->id);
        session()->put('cart.vnd', $cart->vnd);
        session()->put('cart.usd', $cart->usd);
        session()->put('cart.quantity', $cart->quantity);
        session()->put('cart.discount_vnd', $cart->discount_vnd);
        session()->put('cart.discount_usd', $cart->discount_usd);
        $detail = $cart->detail;
        session()->put('cart.product', []);
        foreach ($detail as $item) {
            $productId = $item->product_id;
            $product = $this->getProduct($item);
            if ( $product ) {
                session()->put('cart.product.' . $productId, $product);
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

    public function checkout()
    {
        session()->forget('cart');
        $userId = Auth::id();
        $cart = $this->cartService->getCartByUser($userId);
        $stores = [];
        if ( $cart ) {
            $cart = $this->getCart($cart);
            foreach ($cart['product'] as $cartDetail) {
                $store = $cartDetail->product->store;
                $storeId = $store->id;
                $storeName = $store->name;
                if ( !array_key_exists($storeId, $stores) ) {
                    $stores[$storeId] = [
                        'lat' => $store->address->lat,
                        'lng' => $store->address->lng,
                        'name' => $store->name,
                    ];
                }
            }
        }

        $stores = json_encode($stores);

        return view(
            'layouts.checkout',
            [
                'cart' => $cart,
                'stores' => $stores
            ]
        );
    }
}
