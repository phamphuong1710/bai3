<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CartService;
use Auth;
use Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct( CartService $cartService )
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $request->session()->forget('cart');
        $cart = $this->cartService->getCartByUser();
        if ( $cart ) {
            $cart = $this->getCart($cart);
            $products = $cart['product'];
            $productId = $request->product_id;
            $currentCart = $this->cartService->updateCart($cart['id'], $request);
            if ( array_key_exists($productId, $products) ) {
                $cartDetail = $this->cartService->updateCartDetail($cart['id'], $request);
            } else {
                $cartDetail = $this->cartService->createCartDetail($cart['id'], $request);
            }
            $product = $this->getProduct($cartDetail);
            $request->session()->put('cart.product.' . $productId, $product);
        } else {
            $currentCart = $this->cartService->createCart($request);
            $cartDetail = $this->cartService->createCartDetail($currentCart->id, $request);
            $product = $this->getProduct($cartDetail);
            $data = [
                'id' => $currentCart->id,
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
        $cartDetail = $this->cartService->deleteCartDetail($id);
        session()->forget('cart');
        $cart = $this->cartService->getCartByUser();
        $cart = $this->getCart($cart);

        return response()->json($cart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCart($cart)
    {
        session()->put('cart.id', $cart->id);
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
        if ( $product ) {
            $logo = $product->media->where('active', 1)->first;
            $product->logo = $logo->image_path;
            $product->quantity = $cartDetail->quantity;
            $product->detail_id = $cartDetail->id;
        }

        return $product;
    }
}
