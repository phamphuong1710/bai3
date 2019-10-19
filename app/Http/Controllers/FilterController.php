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
        $keyword = $request->search;
        $stores = $this->searchService->search($keyword);

        return view('layouts.search', ['products' => null, 'stores' => $stores]);
    }

    // For Headers
    public function getStore(Request $request)
    {
        $keyword = $request->search;
        $stores = $this->searchService->search($keyword);

        return response()->json($stores);
    }

    // Search Product
    public function searchProduct(Request $request)
    {
        $products = $this->searchService->searchProduct($request);
        if ( $products ) {
            foreach ($products as $index => $product) {
                $logo = $product->media->where('active', 1)->first()->image_path;
                $products[$index]->logo = $logo;
            }
        }

        return view('layouts.search', ['products' => $products, 'stores' => null]);
    }

    // Rating Store
    public function filterStoreByRating(Request $request)
    {
        $star = (int)$request->rating;
        $stores = $this->ratingService->getStoreByRating($star);
        if ( $stores ) {
            foreach ($stores as $index => $store) {
                $logo = $store->media->where('active', 1)->first()->image_path;
                $address = $store->address->address;
                $stores[$index]->logo = $logo;
                $stores[$index]->address = $address;
            }
        }
        $stores->star = $star;

        return response()->json($stores);
    }

    // Rating Product
    public function filterProductByRating(Request $request)
    {
        $star = (int)$request->rating;
        $products = $this->ratingService->getProductByRating($star);
        if ( $products ) {
            foreach ($products as $index => $product) {
                $logo = $product->media->where('active', 1)->first()->image_path;
                $products[$index]->logo = $logo;
            }
        }
        $products->star = $star;

        return view('layouts.search', ['products' => $products, 'stores' => null]);
    }

    //Search Product In Store
    public function searchProductInStore(Request $request)
    {
        $storeId = (int)$request->store;
        $keyword = $request->product;
        $products = $this->searchService->searchProductInStore($storeId, $keyword);

        return response()->json($products);
    }
}
