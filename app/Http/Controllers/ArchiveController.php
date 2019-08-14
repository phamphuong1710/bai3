<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\StoreService;

class ArchiveController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct( ProductService $productService, CategoryService $categoryService, StoreService $storeService )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
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


    public function store($slug)
    {
        $store = $this->storeService->getStoreBySlug($slug);
        $products = $this->productService->getAllProductStore($store->id);
        $store->products = $products;

        return view('layouts.store', compact('store'));
    }
}
