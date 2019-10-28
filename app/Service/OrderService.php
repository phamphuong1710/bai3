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
    protected $orderModel;
    protected $cartModel;
    protected $addressModel;
    protected $productModel;
    protected $orderDetailModel;

    public function __construct(Order $orderModel, Product $productModel, Cart $cartModel, Address $addressModel, OrderDetail $orderDetailModel)
    {
        $this->productModel = $productModel;
        $this->orderModel = $orderModel;
        $this->addressModel = $addressModel;
        $this->cartModel = $cartModel;
        $this->orderDetailModel = $orderDetailModel;
    }

    public function order($vnd, $usd, $quantity, $userId)
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->vnd = $vnd;
        $order->usd = $usd;
        $order->quantity = $quantity;
        $order->save();

        return $order;
    }

    public function orderDetail($orderId, $userId)
    {
        $cart = $this->cartModel->where('user_id', $userId)
            ->firstOrFail();
        $cartDetails = $cart->detail;
        $orderDetails = [];
        foreach ($cartDetails as $detail) {
            $order = new OrderDetail();
            $product = $this->productModel->findOrFail( $detail->product_id );
            $order->order_id = $orderId;
            $order->product_id = $detail->product_id;
            $order->quantity = $detail->quantity;
            $order->usd = $detail->usd;
            $order->vnd = $detail->vnd;
            $order->discount_usd = $detail->discount_usd;
            $order->discount_vnd = $detail->discount_vnd;
            $order->store_id = $product->store_id;
            $order->save();
            array_push( $orderDetails, $order);
            $product->total_sale = $product->total_sale + $detail->quantity;
            $product->quantity_stock = $product->quantity_stock - $detail->quantity;
            $product->save();
        }

        return $orderDetails;
    }


    public function updateUserInfo($userId, $phone, $name)
    {
        $user = User::findOrFail($userId);
        if(!$user) abort('404');
        $user->phone = $phone;
        $user->full_name = $name;
        $user->save();

        return $user;
    }

    public function createUserAddress($userId, $address, $lat, $lng)
    {
        $oldAddress = $this->addressModel->where('user_id', $userId)->get();
        foreach ($oldAddress as $address) {
            $addr = $this->addressModel->findOrFail($address->id)->update(['active' => 0]);
        }
        $args = [
            'user_id' => $userId,
            'address' => $address,
            'lat' => $lat,
            'lng' => $lng,
            'active' => 1,
        ];
        $this->addressModel->create($args);

        return $address;
    }

    public function getOrder()
    {
        $orders = $this->orderModel->paginate(15);
       foreach ($orders as $key => $order) {
            $orders[$key]->detail = $order->orderDetail;
            $orders[$key]->user = $order->user;
        }

        return $orders;
    }

    public function getOrderById($id)
    {
        $order = $this->orderModel->findOrFail($id);

        return $order;
    }

    public function updateOrder($request, $id)
    {
        $order = $this->getOrderById($id);
        if ( $request->status ) {
            $order->status = $request->status;
        }
        $order->save();

        return $order;
    }

    public function getListOrderDetail($listId)
    {
        $orderDetail = $this->orderDetailModel->whereIn('id', $listId)->get();

        return $orderDetail;
    }
}

