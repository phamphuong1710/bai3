<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\CategoryService;
use App\Service\SliderService;

class HomeController extends Controller
{
    protected $productService;
    protected $sliderService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        SliderService $sliderService,
        CategoryService $categoryService
    )
    {
        $this->productService = $productService;
        $this->sliderService = $sliderService;
        $this->categoryService = $categoryService;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bestSeller = $this->productService->getProductBestSeller();
        $new = $this->productService->getNewProduct();
        $slider = $this->sliderService->getSlider();
        return view('layouts/home', [ 'bestSeller' => $bestSeller, 'new' => $new, 'slider' => $slider ]);
    }
}
