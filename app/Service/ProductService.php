<?php
namespace App\Service;

use App\InterfaceService\ProductInterface;
use App\Product; // model
use Carbon\Carbon;

class ProductService implements ProductInterface
{

    public function getAllProductStore($storeId)
    {
        $products = Product::where('store_id', $storeId)->get();

        return $products;
    }

    public function createProduct($request)
    {
        $product = new Product();
        $time = Carbon::now()->timestamp;
        $product->name = $request->name;
        $product->slug = str_slug($request->name, '-').'-'.$request->store_id.$time;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->user_id = $request->user_id;
        $product->store_id = $request->store_id;
        $product->quantity_stock = $request->quantity;
        $product->save();

        return $product->id;
    }

    public function getProductId($id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    public function updateProduct($request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = str_slug($request->name, '-');
        $product->phone = $request->phone;
        $product->description = $request->description;
        $product->user_id = $request->user_id;
        $product->save();
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);

    }
}

