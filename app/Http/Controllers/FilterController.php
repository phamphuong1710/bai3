<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SearchService;

class FilterController extends Controller
{
    protected $productService;

    public function __construct( SearchService $searchService )
    {
        $this->searchService = $searchService;
    }

    public function search(Request $request)
    {
        $products = $this->searchService->searchProduct($request);
        $stores = $this->searchService->searchStore($request);

        return view('layouts.search', ['products' => $products, 'stores' => $stores]);
    }
}
