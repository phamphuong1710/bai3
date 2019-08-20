<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\StoreService;
use App\Service\RatingService;

class ArchiveController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $ratingService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        StoreService $storeService,
         RatingService $ratingService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->storeService = $storeService;
        $this->ratingService = $ratingService;
    }

    public function product($slug)
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        $listCategory = getChildCategory($category->id);
        $products = $this->productService->getProductInCategory($listCategory);
        $products->category = $category;

        return view('layouts.archive-category', compact('products'));
    }


    public function store($slug)
    {
        $store = $this->storeService->getStoreBySlug($slug);
        $products = $this->productService->getAllProductStore($store->id);
        $store->products = $products;
        $rating = $this->ratingService->getRatingStoreByUser($store->id);
        if (!$rating) {
            $rating = false;
        }
        $store->user_rating = $rating;

        return view('layouts.store', compact('store'));
    }

    public function productDiscount($discount)
    {
        $products = $this->productService->getProductDiscount($discount);

         return view('layouts.search', ['products' => $products, 'stores' => null]);
    }
}
