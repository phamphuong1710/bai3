<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\RatingService;

class SingleProductController extends Controller
{
    protected $productService;
    protected $ratingService;

    public function __construct( ProductService $productService, RatingService $ratingService )
    {
        $this->productService = $productService;
        $this->ratingService = $ratingService;
    }

    public function product($slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        if (!$product) {
            abort('404');
        }
        $productStore = $this->productService->getTheSameProductInStore($product->store_id, $product->id);
        $productCategory = $this->productService->getTheSameProductInCategory($product->category, $product->id);
        $product->in_store = $productStore;
        $product->in_category = $productCategory;
        $rating = $this->ratingService->getRatingProductByUser($product->id);
        if (!$rating) {
            $rating = false;
        }
        $product->user_rating = $rating;

        return view('layouts.product-single', compact('product'));
    }
}
