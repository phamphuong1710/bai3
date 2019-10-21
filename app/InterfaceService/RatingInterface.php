<?php

namespace App\InterfaceService;

interface RatingInterface {
    public function ratingProduct($productId, $userId, $star);

    public function ratingStore($storeId, $userId, $star);

    public function getRatingProductByUser($productId, $userId);

    public function getRatingStoreByUser($storeId, $userId);

    public function getStoreByRating($rating);

    public function getProductByRating($rating);
}
