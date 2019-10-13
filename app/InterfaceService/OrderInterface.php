<?php

namespace App\InterfaceService;

interface OrderInterface {
    public function order($vnd, $usd, $quantity, $userId);

    public function orderDetail($orderId, $userId);

    public function updateUserInfo($userId, $phone, $name);

    public function createUserAddress($userId, $address, $lat, $lng);

    public function getOrderById($id);

    public function getListOrderDetail($listId);
}
