<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;

class SingleProductController extends Controller
{
    protected $productService;

    public function __construct( ProductService $productService )
    {
        $this->productService = $productService;
    }

    public function product($slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        if (!$product) {
            abort('404');
        }

        return view('layouts.product-single', compact('product'));
    }
}
