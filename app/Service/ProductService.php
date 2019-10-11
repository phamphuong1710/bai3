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

    public function getAllProductByUser($request)
    {
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $products;
    }

    public function getAllProduct()
    {
        $products = Product::paginate(15);

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
        $product->user_id = $request->user_id;
        $product->store_id = $request->store_id;
        $product->quantity_stock = $request->quantity;
        if ( !empty( $request->on_sale ) ) {
            $product->on_sale = $request->on_sale;
        }
        if (app()->getLocale() == 'en') {
            $product->usd = $request->sale_price;
            $price = (float)$request->sale_price * (float)$request->usd_to_vnd;
            $product->vnd = formatNumber($price, 2);
            $product->usd_entered = $request->price;
            $price = (float)$request->price * (float)$request->usd_to_vnd;
            $product->vnd_entered = formatNumber($price, 2);
        } else {
            $product->vnd = $request->sale_price;
            $price = (float)$request->sale_price/(float)$request->usd_to_vnd;
            $product->usd = formatNumber($price, 2);
            $product->vnd_entered = $request->price;
            $price = (float)$request->sale_price/(float)$request->usd_to_vnd;
            $product->usd_entered = formatNumber($price, 2);
        }
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
        if (app()->getLocale() == 'en') {
            $product->usd = $request->sale_price;
            $price = (float)$request->sale_price * (float)$request->usd_to_vnd;
            $product->vnd = formatNumber($price, 2);
            $product->usd_entered = $request->price;
            $price = (float)$request->price * (float)$request->usd_to_vnd;
            $product->vnd_entered = formatNumber($price, 2);
        } else {
            $product->vnd = $request->sale_price;
            $price = (float)$request->sale_price/(float)$request->usd_to_vnd;
            $product->usd = formatNumber($price, 2);
            $product->vnd_entered = $request->price;
            $price = (float)$request->sale_price/(float)$request->usd_to_vnd;
            $product->usd_entered = formatNumber($price, 2);
        }
        if ( !empty( $request->on_sale ) ) {
            $product->on_sale = $request->on_sale;
        }
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
        $product = Product::where('store_id', $storeId)
            ->where('name', 'like', '%'.$request->product.'%')
            ->get();

        return $product;
    }

    // Filter All Product In Store
    public function filterAllProductStore($request)
    {
        $storeId = (int)$request->store_id;
        $products = Product::where('store_id', $storeId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $products;
    }

    // Filter Product By Category In Store
    public function filterProductByCategory($request, $listCategory)
    {
        $storeId = (int)$request->store;
        $product = Product::whereIn('category_id', $listCategory)
            ->where('store_id', $storeId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $product;
    }

    public function getProductByUser()
    {
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)->paginate(15);

        return $products;
    }

    //Search Product By User
    public function searchProductByUser($request)
    {
        $userId = Auth::id();
        $product = Product::where('user_id', $userId)
            ->where('name', 'like', '%'.$request->product.'%')
            ->orwhere('description', 'like', '%'.$request->product.'%')
            ->get();

        return $product;
    }

    // Filter Product By Category By User
    public function filterProductByUserCategory($request, $listCategory)
    {
        $userId = Auth::id();
        $product = Product::whereIn('category_id', $listCategory)
            ->where('user_id', $userId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $product;
    }

    public function getProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return $product;
    }

    public function getTheSameProductInCategory($categoryId, $productId)
    {
        $products = Product::where('category_id', $categoryId)
                    ->whereNotIn('id', [$productId])->paginate(4);

        return $products;
    }

    public function getTheSameProductInStore($storeId, $productId)
    {
        $products = Product::where('store_id', $storeId)
                    ->whereNotIn('id', [$productId])->paginate(4);

        return $products;
    }

    // Get All Product In category
    public function getProductInCategory($listCategory)
    {
        $product = Product::whereIn('category_id', $listCategory)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $product;
    }

    // Get Product Discount
    public function getProductDiscount($discount)
    {
        $product = Product::where('on_sale', '>=', $discount)
            ->where('on_sale', '<', $discount + 10)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $product;
    }

    public function getProductByCategoryInStore($storeId, $categoryId)
    {
        $products = Product::where('store_id', $storeId)
            ->where('category_id', $categoryId)
            ->get();

        return $products;
    }
}

