<?php
namespace App\Service;

use App\InterfaceService\RatingInterface;
use App\Rating;
use App\Store;
use App\Product; // model
use Carbon\Carbon;

class RatingService implements RatingInterface
{
    protected $ratingModel;
    protected $storeModel;
    protected $productModel;

    public function __construct( Rating $ratingModel, Product $productModel, Store $storeModel )
    {
        $this->ratingModel = $ratingModel;
        $this->storeModel = $storeModel;
        $this->productModel = $productModel;
    }

    public function ratingProduct($productId, $userId, $star)
    {
        $rating = new Rating();
        $rating->star = $star;
        $rating->product_id = $productId;
        $rating->user_id = $userId;
        $rating->save();
        $ratingAverage = $this->ratingModel->where('product_id', $productId)->avg('star');
        $product = $this->productModel->findOrFail($productId);
        $product->rating_average = $ratingAverage;
        $product->save();
        $number = $product->rating->count();
        $rating->number = formatNumber($number,1);
        $rating->rating_average = $ratingAverage;

        return $rating;
    }

    public function ratingStore($storeId, $userId, $star)
    {
        $rating = new Rating();
        $rating->star = $star;
        $rating->store_id = $storeId;
        $rating->user_id = $userId;
        $rating->save();
        $ratingAverage = $this->ratingModel->where('store_id', $storeId)->avg('star');
        $store = $this->storeModel->findOrFail($storeId);
        $store->rating_average = $ratingAverage;
        $store->save();
        $number = $store->rating->count();
        $rating->number = formatNumber($number,1);
        $rating->rating_average = $ratingAverage;

        return $rating;
    }

    public function getRatingProductByUser($productId, $userId)
    {
        $rating = $this->ratingModel->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        return $rating;
    }

    public function getRatingStoreByUser($storeId, $userId)
    {
        $rating = $this->ratingModel->where('user_id', $userId)
            ->where('store_id', $storeId)
            ->first();

        return $rating;
    }


    public function getStoreByRating($rating)
    {
        $store = $this->storeModel->where('rating_average', '>=', $rating)
            ->where('rating_average', '<', $rating )
            ->paginate(16);
        if ( $stores ) {
            foreach ($stores as $index => $store) {
                $logo = $store->media->where('active', 1)->first()->image_path;
                $address = $store->address->address;
                $stores[$index]->logo = $logo;
                $stores[$index]->address = $address;
            }
        }
        $stores->star = $star;

        return $store;
    }

    public function getProductByRating($rating)
    {
        $product = $this->productModel->where('rating_average', '>=', $rating)
            ->where('rating_average', '<', $rating)
            ->paginate(16);
        if ( $products ) {
            foreach ($products as $index => $product) {
                $logo = $product->media->where('active', 1)->first()->image_path;
                $products[$index]->logo = $logo;
            }
        }
        $products->star = $star;

        return $product;
    }
}

