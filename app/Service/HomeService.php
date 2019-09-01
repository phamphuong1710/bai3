<?php

namespace App\Service;

use App\InterfaceService\HomeInterface;
use App\Store;
use App\Product;
use App\Slider;

class HomeService implements HomeInterface
{
    public function getSlider()
    {
        $slider = Slider::orderBy('created_at', 'desc')
            ->paginate(3);

        return $slider;
    }

    public function getTopStoreRating()
    {
        $store = Store::orderBy( 'rating_average', 'DESC' )
            ->paginate(8);

        return $store;
    }

    public function getStoreBestSeller()
    {
        $store = Store::orderBy( 'total_sale', 'DESC' )
            ->paginate(8);

        return $store;
    }

    public function getProductBestSeller()
    {
        $product = Product::orderby('total_sale', 'desc')
            ->paginate(8);

        return $product;
    }

    public function getNewProduct()
    {
        $product = Product::orderby('created_at', 'desc')
            ->paginate(8);

        return $product;
    }

    public function getOnSaleProduct()
    {
        $product = Product::orderBy('on_sale', 'desc')
            ->paginate(3);

        return $product;
    }
}
