<?php
namespace App\Service;

use App\InterfaceService\RatingInterface;
use App\Rating;
use App\Store;
use App\Product; // model
use Carbon\Carbon;
use Auth;

class RatingService implements RatingInterface
{
    public function ratingProduct($request)
    {
        $productId = (int)$request->product_id;
        $rating = new Rating();
        $rating->star = $request->star;
        $rating->product_id = $productId;
        $rating->user_id = Auth::id();
        $rating->save();
        $ratingAverage = Rating::where('product_id', $productId)->avg('star');
        $product = Product::findOrFail($productId);
        $product->rating_average = $ratingAverage;
        $product->save();
        $number = $product->rating->count();
        $rating->number = formatNumber($number,1);
        $rating->rating_average = $ratingAverage;

        return $rating;
    }

    public function ratingStore($request)
    {
        $storeId = (int)$request->store_id;
        $rating = new Rating();
        $rating->star = $request->star;
        $rating->store_id = $storeId;
        $rating->user_id = Auth::id();
        $rating->save();
        $ratingAverage = Rating::where('store_id', $storeId)->avg('star');
        $store = Store::findOrFail($storeId);
        $store->rating_average = $ratingAverage;
        $store->save();
        $number = $store->rating->count();
        $rating->number = formatNumber($number,1);
        $rating->rating_average = $ratingAverage;

        return $rating;
    }

    public function getRatingProductByUser($productId)
    {
        $rating = Rating::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        return $rating;
    }

    public function getRatingStoreByUser($storeId)
    {
        $rating = Rating::where('user_id', Auth::id())
            ->where('store_id', $storeId)
            ->first();

        return $rating;
    }


    public function getStoreByRating($rating)
    {
        $store = Store::where('rating_average', '>=', $rating)
            ->where('rating_average', '<', $rating + 0.5)
            ->paginate(16);

        return $store;
    }

    public function getProductByRating($rating)
    {
        $product = Product::where('rating_average', '>=', $rating)
            ->where('rating_average', '<', $rating + 0.5)
            ->paginate(16);

        return $product;
    }
}

