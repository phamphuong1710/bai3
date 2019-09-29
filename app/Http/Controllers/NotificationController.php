<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\OrderNotification;
use App\Service\UserService;
use App\Service\OrderService;
use Auth;

class NotificationController extends BaseController
{
    protected $orderService;
    protected $userService;

    public function __construct(UserService $userService, OrderService $orderService )
    {
        $this->middleware('auth');
        parent::__construct($userService);
        $this->userService = $userService;
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $listNote = [];
        foreach ($user->notifications as $notification) {
            $listNote[] = $notification;
        }

        return view('admin.notify.list', compact('listNote'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $notify = $user->notifications->where( 'id', $id )->first();
        $detail = $notify->data;
        $detail = json_encode($detail);
        $detail = json_decode($detail);
        $custommer = $this->userService->getUserById($detail->user);
        $address = $custommer->address->where('active', 1)->first()->address;
        $custommer->address = $address;
        $order = $this->orderService->getOrderById($detail->order_id);
        $orderDetail = $order->orderDetail->where('id', $detail->detail)->first();
        $notify->update(['read_at' => now()]);

        return view('admin.notify.detail', compact('custommer', 'order', 'orderDetail'));
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
