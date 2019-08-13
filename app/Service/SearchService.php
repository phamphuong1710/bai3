<?php
namespace App\Service;

use App\InterfaceService\SearchInterface;
use App\Product; // model
use App\Store; // model

class SearchService implements SearchInterface
{
    public function searchProduct($request)
    {
        $products = Product::where('name', 'like', '%'.$request->search.'%')
            ->orWhere('description',  'like', '%'.$request->search.'%')
            ->get();

        return $products;
    }

    public function searchStore($request)
    {
        $stores = Store::where('name', 'like', '%'.$request->search.'%')
            ->orWhere('description',  'like', '%'.$request->search.'%')
            ->get();

        return $stores;
    }
}

