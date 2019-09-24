<?php
namespace App\Service;

use App\InterfaceService\OrderInterface;
use App\Order;
use App\Cart;
use App\User;
use App\Address;
use App\Product;
use App\OrderDetail;

class OrderService implements OrderInterface
{
    public function order($request, $userId)
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->vnd = $request->vnd;
        $order->usd = $request->usd;
        $order->quantity = $request->quantity;
        $order->save();

        return $order;
    }

    public function orderDetail($orderId, $userId)
    {
        $cart = Cart::where('user_id', $userId)
            ->first();
        $cartDetails = $cart->detail;
        $orderDetails = [];
        foreach ($cartDetails as $detail) {
            $order = new OrderDetail();
            $order->order_id = $orderId;
            $order->product_id = $detail->product_id;
            $order->quantity = $detail->quantity;
            $order->usd = $detail->usd;
            $order->vnd = $detail->vnd;
            $order->discount_usd = $detail->discount_usd;
            $order->discount_vnd = $detail->discount_vnd;
            $order->save();
            array_push( $orderDetails, $detail);
            $product = Product::findOrFail( $detail->product_id );
            $product->total_sale = $product->total_sale + $detail->quantity;
            $product->quantity_stock = $product->quantity_stock - $detail->quantity;
            $product->save();
        }

        return $orderDetails;
    }


    public function updateUserInfo($userId, $request)
    {
        $user = User::findOrFail($userId);
        if(!$user) abort('404');
        $user->phone = $request->phone;
        $user->full_name = $request->name;
        return $user;
    }

    public function createUserAddress($userId, $request)
    {
        $address = new Address();
        $address->user_id = $userId;
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->active = 1;
        $address->save();
        $oldAddress = Address::where('user_id', $userId)
            ->get();
        foreach ($oldAddress as $address) {
            $addr = Address::findOrFail($address->id);
            $addr->active = 0;
        }

        return $address;
    }

    public function getOrder()
    {
        $orders = Order::paginate(15);

        return $orders;
    }

    public function getOrderById($id)
    {
        $order = Order::findOrFail($id);

        return $order;
    }
}

