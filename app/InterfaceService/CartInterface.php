<?php

namespace App\InterfaceService;

interface CartInterface {
    public function createCart($userId);

    public function createCartDetail($cartId, $productId, $quantity);

    public function updateCart($cartId);

    public function updateCartDetail($cartId, $productId, $quantity);

    public function getCartByUser($userId);
}
