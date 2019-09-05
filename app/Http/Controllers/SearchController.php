<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\StoreService;
use App\Service\UserService;
use App\Service\CategoryService;

class SearchController extends Controller
{
    protected $storeService;
    protected $productService;
    protected $userService;
    protected $categoryService;

    public function __construct( StoreService $storeService, ProductService $productService, UserService $userService, CategoryService $categoryService )
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
        $this->productService = $productService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }

    public function searchStore(Request $request)
    {
        $stores = $this->storeService->searchStore($request);
        foreach ($stores as $index => $store) {
            $stores[$index]->logo = $store->media->where('active', 1)->first();
            $stores[$index]->address = $store->address->address;
        }

        return response()->json($stores);
    }

    public function filterStore(Request $request)
    {
        $stores = $this->storeService->filterStore($request);
        foreach ($stores as $index => $store) {
            $stores[$index]->logo = $store->media->where('active', 1)->first();
            $stores[$index]->address = $store->address->address;
        }

        return response()->json($stores);
    }

    // Search Product In Store
    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProduct($request);
        foreach ($products as $key => $product) {
            $products[$key]->logo = $product->media->where('active', 1)->first();
        }

        return response()->json($products);
    }

    // Filter Product in category in Store
    public function filterByCategory(Request $request)
    {
        if ($request->category == 0) {
            $products = $this->productService->filterAllProductStore($request);
        }
        else {
            $listCategory = getChildCategory($request->category);
            $products = $this->productService->filterProductByCategory($request, $listCategory);
        }
        foreach ($products as $key => $product) {
            $products[$key]->logo = $product->media->where('active', 1)->first();
        }

        return response()->json($products);
    }

    // Search Product Create By User
    public function searchProductByUser(Request $request)
    {
        $products = $this->productService->searchProductByUser($request);
        foreach ($products as $key => $product) {
            $products[$key]->logo = $product->media->where('active', 1)->first();
        }

        return response()->json($products);
    }

    // Filter Product in category create by User
    public function filterByCategoryUser(Request $request)
    {
        if ($request->category == 0) {
            $products = $this->productService->getAllProductByUser($request);
        }
        else {
            $listCategory = getChildCategory($request->category);
            $products = $this->productService->filterProductByUserCategory($request, $listCategory);
        }
        $html = getProductHtml($products);

        return response()->json($html);
    }

    public function searchUser(Request $request)
    {
        $users = $this->userService->searchUser($request);

        return response()->json($users);
    }

    public function filterUser(Request $request)
    {
        $users = $this->userService->filterUser($request);

        return response()->json($users);
    }

    public function searchCategory(Request $request)
    {
        $categories = $this->categoryService->searchCategory($request);

        return response()->json($categories);
    }

    public function filterCategory(Request $request)
    {
        $categories = $this->categoryService->filterCategory($request);

        return response()->json($categories);
    }

}
