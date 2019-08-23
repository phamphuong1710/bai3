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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->forget('cart');
        $cart = $this->cartService->getCartByUser();
        if ( $cart ) {
            $cart = $this->getCart($request, $cart);
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
            $data = [
                'id' => $currentCart->id,
                'product' => [
                    $cartDetail->id => $cartDetail,
                ]
            ];
            $request->session()->put('cart', $data);
        }

        $cart = $request->session()->get('cart');
        dd($cart);

        return view('layouts.cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function getCart($request, $cart)
    {
        $request->session()->put('cart.id', $cart->id);
        $detail = $cart->detail;
        foreach ($detail as $item) {
            $productId = $item->product_id;
            $product = $this->getProduct($item);
            $request->session()->put('cart.product.' . $productId, $product);
        }
        $cart = $request->session()->get('cart');

        return $cart;
    }

    public function getProduct($cartDetail)
    {
        $product = $cartDetail->product;
        $logo = $product->media->where('active', 1)->first;
        $product->toArray();
        $product['logo'] = $logo->image_path;
        $product['quantity'] = $cartDetail->quantity;

        return $product;
    }
}
