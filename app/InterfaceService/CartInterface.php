<?php

namespace App\InterfaceService;

interface CartInterface {
    public function createCart($userId, $storeId = null, $slug = false);

    public function createCartDetail($cartId, $productId, $quantity, $userId);

    public function updateCart($cartId);

    public function updateCartDetail($cartId, $productId, $quantity);

    public function getCartByUser($userId);
}
