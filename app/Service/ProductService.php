<?php
namespace App\Service;

use App\InterfaceService\ProductInterface;
use App\Product; // model
use Carbon\Carbon;
use Auth;

class ProductService implements ProductInterface
{

    public function getAllProductStore($storeId)
    {
        $products = Product::where('store_id', $storeId)->paginate(15);

        return $products;
    }

    public function getAllProductInStore($storeId)
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

        return $product;
    }

    public function getProductId($id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    public function updateProduct($request, $id)
    {
        $product = Product::findOrFail($id);
        $time = Carbon::now()->timestamp;
        $product->name = $request->name;
        $product->slug = str_slug($request->name, '-').'-'.$request->store_id.$time;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->user_id = $request->user_id;
        $product->quantity_stock = $request->quantity;
        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);

        return $product;
    }

    //Seach Product In Store
    public function searchProduct($request)
    {
        $storeId = (int)$request->store;
        $product = Product::where('store_id', $storeId)->where('name', 'like', '%'.$request->product.'%')->get();

        return $product;
    }

    // Filter Product By Category In Store
    public function filterProductByCategory($request)
    {
        $cat = (int)$request->category;
        $storeId = (int)$request->store;
        if ( $cat == 0 ) {
            $product = Product::where('store_id', $storeId)
            ->get();
        }
        else {
            $product = Product::where('category_id', $cat)
            ->where('store_id', $storeId)
            ->get();
        }

        return $product;
    }

    public function getProductByUser()
    {
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)->get();

        return $products;
    }

    //Search Product By User
    public function searchProductByUser($request)
    {
        $userId = Auth::id();
        $product = Product::where('user_id', $userId)
            ->where('name', 'like', '%'.$request->product.'%')
            ->get();

        return $product;
    }

    // Filter Product By Category By User
    public function filterProductByUserCategory($request)
    {
        $cat = (int)$request->category;
        $storeId = (int)$request->store;
        if ( $cat == 0 ) {
            $product = Product::where('store_id', $storeId)
            ->get();
        }
        else {
            $product = Product::where('category_id', $cat)
            ->where('store_id', $storeId)
            ->get();
        }

        return $product;
    }
}

