<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\StoreService;

class SearchController extends Controller
{
    protected $storeService;
    protected $productService;

    public function __construct( StoreService $storeService, ProductService $productService )
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
        $this->productService = $productService;
    }

    public function searchStore(Request $request)
    {
        $stores = $this->storeService->searchStore($request);
        $html = listStoreHtml($stores);

        return response()->json($html);
    }

    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProduct($request);
        $html = getProductHtml($products);

        return response()->json($html);
    }

    public function filterByCategory(Request $request)
    {
        $products = $this->productService->filterProductByCategory($request);
        $html = getProductHtml($products);

        return response()->json($html);
    }

    public function searchProductByUser(Request $request)
    {
        $products = $this->productService->searchProductByUser($request);
        $html = getProductHtml($products);

        return response()->json($html);
    }
}
