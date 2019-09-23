<?php

namespace App\InterfaceService;

interface OrderInterface {
    public function order($request, $userId);
    public function orderDetail($orderId, $userId);
    public function updateUserInfo($userId, $request);
    public function createUserAddress($userId, $request);
}
