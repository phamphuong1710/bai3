<?php

namespace App\InterfaceService;

interface HomeInterface {
    public function getSlider();

    public function getTopStoreRating();

    public function getProductBestSeller();

    public function getNewProduct();

    public function getOnSaleProduct();
}
