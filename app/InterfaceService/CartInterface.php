<?php

namespace App\InterfaceService;

interface CartInterface {
    public function createCart($request);
    public function createCartDetail($cartId, $request);
    public function updateCart($cartId, $request);
    public function updateCartDetail($cartId, $request);
    public function getCartByUser();
}