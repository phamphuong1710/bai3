<?php

namespace App\InterfaceService;

interface RatingInterface {
    public function ratingProduct($request);
    public function ratingStore($request);
    public function getRatingProductByUser($productId);
    public function getRatingStoreByUser($storeId);
}
