<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Service\OrderService;
use App\Service\CartService;
use Auth;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;

    public function __construct( OrderService $orderService, CartService $cartService )
    {
        $this->orderService = $orderService;
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
    public function store(OrderRequest $request)
    {
        $userId = Auth::id();
        $order = $this->orderService->order($request, $userId);
        $orderId = $order->id;
        $listOrder = $this->orderService->orderDetail($orderId, $userId);
        $cart = $this->cartService->getCartByUser($userId);
        $this->cartService->deleteCart($cart->id);
        $request->session()->forget('cart');
        $user = $this->orderService->updateUserInfo($userId, $request);
        $address = $this->orderService->createUserAddress($userId, $request);
        $user->total_vnd = $order->vnd;
        $user->total_usd = $order->usd;

        return view(
            'layouts.order',
            [
                'order' => $listOrder,
                'user' => $user,
            ]
        );
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
