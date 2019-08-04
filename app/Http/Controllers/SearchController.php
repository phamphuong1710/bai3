<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\StoreService;
use App\Service\UserService;

class SearchController extends Controller
{
    protected $storeService;
    protected $productService;
    protected $userService;

    public function __construct( StoreService $storeService, ProductService $productService, UserService $userService )
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
        $this->productService = $productService;
        $this->userService = $userService;
    }

    public function searchStore(Request $request)
    {
        $stores = $this->storeService->searchStore($request);
        $html = listStoreHtml($stores);

        return response()->json($html);
    }

    public function filterStore(Request $request)
    {
        $stores = $this->storeService->filterStore($request);
        $html = listStoreHtml($stores);

        return response()->json($html);
    }

    // Search Product In Store
    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProduct($request);
        $html = getProductHtml($products);

        return response()->json($html);
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

        $html = getProductHtml($products);

        return response()->json($html);
    }

    // Search Product Create By User
    public function searchProductByUser(Request $request)
    {
        $products = $this->productService->searchProductByUser($request);
        $html = getProductHtml($products);

        return response()->json($html);
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
        $html = getUserHtml($users);

        return response()->json($html);
    }

    public function filterUser(Request $request)
    {
        $users = $this->userService->filterUser($request);
        $html = getUserHtml($users);

        return response()->json($html);
    }

}
