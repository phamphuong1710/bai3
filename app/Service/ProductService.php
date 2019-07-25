<?php
namespace App\Service;

use App\InterfaceService\ProductInterface;
use App\Product; // model

class ProductService implements ProductInterface
{

    public function getAllProductStore($storeId)
    {
        $products = Product::where('store_id', $storeId)->get();

        return $products;
    }

    public function createProduct($request)
    {
        $store = new Product();
        $store->name = $request->name;
        $store->slug = str_slug($request->name, '-');
        $store->phone = $request->phone;
        $store->description = $request->description;
        $store->user_id = $request->user_id;
        $store->save();

        return $store->id;
    }

    public function getProductId($id)
    {
        $store = Product::findOrFail($id);

        return $store;
    }

    public function updateProduct($request, $id)
    {
        $store = Product::findOrFail($id);
        $store->name = $request->name;
        $store->slug = str_slug($request->name, '-');
        $store->phone = $request->phone;
        $store->description = $request->description;
        $store->user_id = $request->user_id;
        $store->save();
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);

    }
}

