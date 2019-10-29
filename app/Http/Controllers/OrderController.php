<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Service\OrderService;
use App\Service\CartService;
use App\Service\StoreService;
use Notification;
use App\Service\UserService;
use App\Notifications\OrderNotification;
use Auth;

class OrderController extends BaseController
{
    protected $orderService;
    protected $cartService;
    protected $userService;
    protected $storeService;

    public function __construct(
        OrderService $orderService,
        CartService $cartService,
        UserService $userService,
        StoreService $storeService
    )
    {
        $this->middleware('auth');
        parent::__construct($userService);
        $this->orderService = $orderService;
        $this->cartService = $cartService;
        $this->userService = $userService;
        $this->storeService = $storeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $orders = $this->orderService->getOrder($userId);

        return view('admin.order.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $vnd = $request->vnd;
        $usd = $request->usd;
        $quantity = $request->quantity;
        $phone = $request->phone;
        $name = $request->name;
        $order = $this->orderService->order($vnd, $usd, $quantity, $userId);
        $orderId = $order->id;
        $listOrder = $this->orderService->orderDetail($orderId, $userId);
        $cart = $this->cartService->getCartByUser($userId);
        $this->cartService->deleteCart($cart->id);
        $request->session()->forget('cart');
        $user = $this->orderService->updateUserInfo($userId, $phone, $name);
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $address = $this->orderService->createUserAddress($userId, $address, $lat, $lng);
        $user->total_vnd = $order->vnd;
        $user->total_usd = $order->usd;
        $listStore = [];
        $listNote = [];
        foreach ($listOrder as $detail) {
            $storeId = $detail->store_id;
            if (!in_array($storeId, $listStore)) {
                array_push($listStore, $storeId);
                $note = [
                    'order_id' => $orderId,
                    'user' => $user->id,
                    'detail' => [ $detail->id ],
                ];
                $listNote[$storeId] = $note;
            } else {
                array_push($listNote[$storeId]['detail'], $detail->id);
            }
        }
        foreach ($listNote as $storeId => $note) {
            $store = $this->storeService->getStoreById($storeId);
            $userId = $store->user_id;
            $storeUser = $this->userService->getUserById($userId);
            $details = $note;
            Notification::send($storeUser, new OrderNotification($details));
        }

        return redirect()->route('order-template', ['id' => $orderId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        $orderDetail = $order->orderDetail;
        foreach ($orderDetail as $key => $detail) {
            $product = $detail->product;
            $logo = $product->media->where('active', 1)->first();
            $product->logo = $logo->image_path;
            $orderDetail[$key]->product = $product;
        }
        if (app()->getLocale() == 'en') {
            $status = [
                'accept' => 'Accept',
                'failed' => 'Failed',
                'completed' => 'Completed',
                'processing' => 'Processing',
            ];
        } else {
            $status = [
                'accept' => 'Chấp Thuận',
                'failed' => 'Thất Bại',
                'completed' => 'Đã Hoàn Thành',
                'processing' => 'Đang Giao',
            ];
        }
        $user = $order->user;
        $address = $user->address->where('active', 1)->first()->address;
        $user->address = $address;

        return view('admin.order.order-detail', compact('order', 'orderDetail', 'status', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->orderService->getOrderById($id);
        $orderDetail = $order->orderDetail;

        return view('admin.order.edit', compact('order', 'orderDetail'));
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
        $order = $this->orderService->updateOrder($request, $id);

        return redirect()->route('order.index')->with('sucsess', 'Update Sussess');
    }

    public function order($id)
    {
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $order = $this->orderService->getOrderById($id);
        $orderDetail = $order->orderDetail;
        foreach ($orderDetail as $key => $detail) {
            $product = $detail->product;
            $logo = $product->media->where('active', 1)->first();
            $product->logo = $logo->image_path;
            $orderDetail[$key]->product = $product;
        }

        return view(
            'layouts.order',
            [
                'orderDetail' => $orderDetail,
                'order' => $order,
                'user' => $user,
            ]
        );
    }
}
