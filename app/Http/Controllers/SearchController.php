<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\StoreService;
use App\Service\UserService;
use App\Service\CategoryService;
use Auth;

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
        $keyword = $request->store;
        $userId = Auth::id();
        $stores = $this->storeService->searchStore($keyword, $userId);

        return response()->json($stores);
    }

    public function filterStore(Request $request)
    {
        $userId = Auth::id();
        $orderby = $request->orderby;
        $order = $request->order;
        $stores = $this->storeService->filterStore($userId, $orderby, $order);

        return response()->json($stores);
    }

    // Search Product In Store
    public function searchProduct(Request $request)
    {
        $storeId = (int)$request->store;
        $keyword = $request->product;
        $products = $this->searchService->searchProductInStore($storeId, $keyword);

        return response()->json($products);
    }

    // Filter Product in category in Store
    public function filterByCategory(Request $request)
    {
        $categoryId = (int)$request->category;
        $storeId = (int)$request->store;
        $orderby = $request->orderby;
        $order = $request->order;
        $products = $this->productService->filterProductByCategory($storeId, $order, $orderby, $categoryId);

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
        $userId = Auth::id();
        $orderby = $request->order;
        $order = $request->orderby;
        if ($request->category == 0) {
            $products = $this->productService->getAllProductByUser($userId, $orderby, $order);
        }
        else {
            $listCategory = getChildCategory($request->category);
            $products = $this->productService->filterProductByUserCategory($request, $listCategory, $userId);
        }

        return response()->json($products);
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
        $key = $request->category;
        $categories = $this->categoryService->searchCategory($key);

        return response()->json($categories);
    }

    public function filterCategory(Request $request)
    {
        $orderBy = $request->order;
        $order = $request->orderby;
        $categories = $this->categoryService->filterCategory($orderBy, $order);

        return response()->json($categories);
    }

}
