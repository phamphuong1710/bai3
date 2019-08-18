<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SearchService;
use App\Service\RatingService;
use App\Service\ProductService;

class FilterController extends Controller
{
    protected $searchService;
    protected $ratingService;
    protected $productService;

    public function __construct(SearchService $searchService, RatingService $ratingService, ProductService $productService)
    {
        $this->ratingService = $ratingService;
        $this->searchService = $searchService;
        $this->productService = $productService;
    }

    // For Headers
    public function search(Request $request)
    {
        $products = $this->searchService->searchProduct($request);
        $stores = $this->searchService->searchStore($request);

        return view('layouts.search', ['products' => $products, 'stores' => $stores]);
    }

    // Search Product
    public function searchProduct(Request $request)
    {
        $products = $this->searchService->searchProduct($request);

        return view('layouts.search', ['products' => $products, 'stores' => null]);
    }

    // Rating Store
    public function filterStoreByRating(Request $request)
    {
        $star = (int)$request->rating;
        $stores = $this->ratingService->getStoreByRating($star);
        $stores->star = $star;

        return view('layouts.search', ['products' => null, 'stores' => $stores]);
    }

    // Rating Product
    public function filterProductByRating(Request $request)
    {
        $star = (int)$request->rating;
        $products = $this->ratingService->getProductByRating($star);
        $products->star = $star;

        return view('layouts.search', ['products' => $products, 'stores' => null]);
    }

    //Search Product In Store
    public function searchProductInStore(Request $request)
    {
        $products = $this->productService->searchProduct($request);
        $html = getProductTemplate($products);

        return response()->json($html);
    }
}
