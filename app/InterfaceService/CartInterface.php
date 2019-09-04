<?php

namespace App\InterfaceService;

interface CartInterface {
    public function createCart($request, $userId);
    public function createCartDetail($cartId, $request);
    public function updateCart($cartId);
    public function updateCartDetail($cartId, $request);
    public function getCartByUser();
}
