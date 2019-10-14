<?php

namespace App\Service;

use App\InterfaceService\HomeInterface;
use App\Store;
use App\Product;
use App\Slider;

class HomeService implements HomeInterface
{
    protected $sliderModel;
    protected $productModel;
    protected $storeModel;

    public function __construct(Slider $sliderModel, Product $productModel, Store $storeModel)
    {
        $this->sliderModel = $sliderModel;
        $this->productModel = $productModel;
        $this->storeModel = $storeModel;
    }

    public function getSlider()
    {
        $slider = $this->sliderModel->orderBy('created_at', 'desc')
            ->paginate(3);

        return $slider;
    }

    public function getTopStoreRating()
    {
        $store = $this->storeModel->orderBy( 'rating_average', 'DESC' )
            ->paginate(6);

        return $store;
    }

    public function getStoreBestSeller()
    {
        $store = $this->storeModel->orderBy( 'total_sale', 'DESC' )
            ->paginate(6);

        return $store;
    }

    public function getProductBestSeller()
    {
        $product = $this->productModel->orderby('total_sale', 'desc')
            ->paginate(9);

        return $product;
    }

    public function getNewProduct()
    {
        $product = $this->productModel->orderby('created_at', 'desc')
            ->paginate(9);

        return $product;
    }

    public function getOnSaleProduct()
    {
        $product = $this->productModel->orderBy('on_sale', 'desc')
            ->paginate(3);

        return $product;
    }
}
