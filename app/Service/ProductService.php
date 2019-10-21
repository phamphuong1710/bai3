<?php
namespace App\Service;

use App\InterfaceService\ProductInterface;
use App\Product; // model
use App\Category;
use Carbon\Carbon;

class ProductService implements ProductInterface
{
    protected $productModel;
    protected $categoryModel;

    public function __construct(Product $productModel, Category $categoryModel)
    {
        $this->productModel = $productModel;
        $this->categoryModel = $categoryModel;
    }

    public function getAllProductStore($storeId)
    {
        $products = $this->productModel->where('store_id', $storeId)->paginate(15);

        return $products;
    }

    public function getAllProductInStore($storeId)
    {
        $products = $this->productModel->where('store_id', $storeId)->get();

        return $products;
    }

    public function getAllProductByUser($userId, $order, $orderby)
    {
        $products = $this->productModel->where('user_id', $userId)
            ->orderBy($order, $orderby)
            ->get();

        return $products;
    }

    public function getAllProduct()
    {
        $products = $this->productModel->paginate(15);

        return $products;
    }

    public function createProduct($name, $storeId, $categoryId, $description, $userId, $quantity, $onSale, $usdToVnd, $salePrice, $cost)
    {
        $product = new Product();
        $time = Carbon::now()->timestamp;
        $product->name = $name;
        $product->slug = str_slug($name, '-') . '-' . $storeId . $time;
        $product->category_id = $categoryId;
        $product->description = $description;
        $product->user_id = $userId;
        $product->store_id = $storeId;
        $product->quantity_stock = $quantity;
        if ( !empty( $onSale ) ) {
            $product->on_sale = $onSale;
        }
        if (app()->getLocale() == 'en') {
            $product->usd = $salePrice;
            $price = (float)$salePrice * (float)$usdToVnd;
            $product->vnd = formatNumber($price, 2);
            $product->usd_entered = $cost;
            $price = (float)$cost * (float)$usdToVnd;
            $product->vnd_entered = formatNumber($price, 2);
        } else {
            $product->vnd = $salePrice;
            $price = (float)$salePrice/(float)$usdToVnd;
            $product->usd = formatNumber($price, 2);
            $product->vnd_entered = $cost;
            $price = (float)$salePrice/(float)$usdToVnd;
            $product->usd_entered = formatNumber($price, 2);
        }
        $product->save();

        return $product;
    }

    public function getProductId($id)
    {
        $product = $this->productModel->findOrFail($id);
        $product->logo = $product->media->where('active', env('ACTIVE'))->first();

        return $product;
    }

    public function updateProduct($name, $storeId, $categoryId, $description, $userId, $quantity, $onSale, $usdToVnd, $salePrice, $cost, $id)
    {
        $product = $this->productModel->findOrFail($id);
        $time = Carbon::now()->timestamp;
        $product->name = $name;
        $product->slug = str_slug($name, '-') . '-' . $storeId . $time;
        $product->category_id = $categoryId;
        $product->description = $description;
        if (app()->getLocale() == 'en') {
            $product->usd = $salePrice;
            $price = (float)$salePrice * (float)$usdToVnd;
            $product->vnd = formatNumber($price, 2);
            $product->usd_entered = $cost;
            $price = (float)$cost * (float)$usdToVnd;
            $product->vnd_entered = formatNumber($price, 2);
        } else {
            $product->vnd = $salePrice;
            $price = (float)$salePrice/(float)$usdToVnd;
            $product->usd = formatNumber($price, 2);
            $product->vnd_entered = $cost;
            $price = (float)$salePrice/(float)$usdToVnd;
            $product->usd_entered = formatNumber($price, 2);
        }
        if ( !empty( $onSale ) ) {
            $product->on_sale = $onSale;
        }
        $product->user_id = $userId;
        $product->quantity_stock = $quantity;
        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        $this->productModel->destroy($id);

        return $product;
    }


    // Filter All Product In Store
    public function filterAllProductStore($request)
    {
        $storeId = (int)$request->store_id;
        $products = $this->productModel->where('store_id', $storeId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $products;
    }

    // Filter Product By Category In Store
    public function filterProductByCategory($storeId, $order, $orderby, $categoryId)
    {
        $listCategory = $this->getChildCategory($categoryId);
        $products = $this->productModel->whereIn('category_id', $listCategory)
            ->where('store_id', $storeId)
            ->orderBy($orderby, $order)
            ->get();
        foreach ($products as $key => $product) {
            $products[$key]->logo = $product->media->where('active', 1)->first();
        }

        return $products;
    }

    public function getProductByUser($userId)
    {
        $products = $this->productModel->where('user_id', $userId)->paginate(15);

        return $products;
    }

    //Search Product By User
    public function searchProductByUser($request)
    {
        $userId = Auth::id();
        $product = $this->productModel->where('user_id', $userId)
            ->where('name', 'like', '%'.$request->product.'%')
            ->orwhere('description', 'like', '%'.$request->product.'%')
            ->get();

        return $product;
    }

    // Filter Product By Category By User
    public function filterProductByUserCategory($request, $listCategory, $userId)
    {
        $product = $this->productModel->whereIn('category_id', $listCategory)
            ->where('user_id', $userId)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $product;
    }

    public function getProductBySlug($slug)
    {
        $product = $this->productModel->where('slug', $slug)->firstOrFail();

        return $product;
    }

    public function getTheSameProductInCategory($categoryId, $productId)
    {
        $products = $this->productModel->where('category_id', $categoryId)
                    ->whereNotIn('id', [$productId])->paginate(4);

        return $products;
    }

    public function getTheSameProductInStore($storeId, $productId)
    {
        $products = $this->productModel->where('store_id', $storeId)
                    ->whereNotIn('id', [$productId])->paginate(4);

        return $products;
    }

    // Get All Product In category
    public function getProductInCategory($listCategory)
    {
        $product = $this->productModel->whereIn('category_id', $listCategory)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $product;
    }

    // Get Product Discount
    public function getProductDiscount($discount)
    {
        $product = $this->productModel->where('on_sale', '>=', $discount)
            ->where('on_sale', '<', $discount)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $product;
    }

    public function getProductByCategoryInStore($storeId, $categoryId)
    {
        $products = $this->productModel->where('store_id', $storeId)
            ->where('category_id', $categoryId)
            ->get();

        return $products;
    }

    public function getChildCategory($categoryId, $listCategory=[])
    {
        array_push($listCategory, $categoryId);
        $childCategory = $this->categoryModel->where('parent_id', $categoryId)->get();;
        if ( $childCategory ) {
            foreach ($childCategory as $category) {
                $listCategory = getChildCategory($category->id, $listCategory);
            }
        }

        return $listCategory;
    }
}

