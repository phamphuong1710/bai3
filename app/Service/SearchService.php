<?php
namespace App\Service;

use App\InterfaceService\SearchInterface;
use App\Product; // model
use App\Store; // model

class SearchService implements SearchInterface
{
    protected $productModel;
    protected $storeModel;

    public function __construct(Product $productModel, Store $storeModel)
    {
        $this->productModel = $productModel;
        $this->storeModel = $storeModel;
    }

    public function searchProduct($request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('description',  'like', '%' . $request->search . '%')
            ->get();

        return $products;
    }

    public function searchStore($request)
    {
        $stores = Store::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('description',  'like', '%' . $request->search . '%')
            ->get();

        return $stores;
    }

    public function search($keyword)
    {
        $products = $this->productModel->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->get();
        $listStore = [];
        foreach ($products as $product) {
            $storeId = $product->store_id;
            if (!in_array($storeId, $listStore)) {
                array_push($listStore, $storeId);
            }
        }
        $stores = $this->storeModel->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description',  'like', '%' . $keyword . '%')
            ->orwhereIn('id', $listStore)
            ->get();
        if ( $stores ) {
            foreach ($stores as $index => $store) {
                $logo = $store->media->where('active', env('ACTIVE'))->first()->image_path;
                $stores[$index]->logo = $logo;
                $stores[$index]->address = $store->address;
            }
        }

        return $stores;
    }

    public function searchProductInStore($storeId, $keyword)
    {
        $product = $this->productModel->where('store_id', $storeId)
            ->where('name', 'like', '%' . $keyword . '%')
            ->get();
        foreach ($products as $key => $product) {
            $products[$key]->logo = $product->media->where('active', 1)->first();
        }

        return $product;
    }
}

