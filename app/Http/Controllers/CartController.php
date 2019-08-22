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
        // $request->session()->forget('cart');
        $cart = $request->session()->get('cart');
        if ( !$cart  ) {
            $currentCart = $this->cartService->createCart($request);
            $cartDetail = $this->cartService->createCartDetail($currentCart->id, $request);
            $data = [
                'id' => $currentCart->id,
                'product' => [
                    $cartDetail->product_id => $cartDetail->quantity,
                ]
            ];
            $request->session()->put('cart', $data);
        } else {
            $products = $cart['product'];
            $productId = $request->product_id;
            if ( array_key_exists($productId, $products) ) {
                $cartDetail = $this->cartService->updateCartDetail($cart['id'], $request);
                $currentCart = $this->cartService->updateCart($cart['id'], $request);
                $quantity = $cartDetail->quantity;
                $request->session()->put('cart.product.' . $productId, $quantity);
            } else {
                $cart['product'][$productId] = $request->quantity;
                $request->session()->put('cart.product.' . $productId, $request->quantity);
                $currentCart = $this->cartService->updateCart($cart['id'], $request);
                $carDetail = $this->cartService->createCartDetail($cart['id'], $request);
            }
        }

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
}
