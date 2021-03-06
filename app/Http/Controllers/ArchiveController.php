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
        $this->ratingService = $ratingService;
        $this->storeService = $storeService;
    }

    public function product($slug)
    {
        $category = $this->categoryService->getCategoryBySlug($slug);
        $listCategory = getChildCategory($category->id);
        $products = $this->productService->getProductInCategory($listCategory);
        $products->category = $category;

        return view('layouts.archive-category', compact('products'));
    }


    public function productDiscount($discount)
    {
        $products = $this->productService->getProductDiscount($discount);

        return response()->json($products);
    }

    public function allStore(Request $request)
    {
        $stores = $this->storeService->getAllStore();
        if ($request->ajax()) {
            return $stores;
        }

        return view('layouts.stores', compact('stores'));
    }
}
