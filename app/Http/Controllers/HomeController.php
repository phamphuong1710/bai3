<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\CartService;
use App\Service\SliderService;

class HomeController extends Controller
{
    protected $productService;
    protected $sliderService;
    protected $cartService;

    public function __construct(
        ProductService $productService,
        SliderService $sliderService,
        CartService $cartService
    )
    {
        $this->productService = $productService;
        $this->sliderService = $sliderService;
        $this->cartService = $cartService;
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
        session()->forget('cart');
        $bestSeller = $this->productService->getProductBestSeller();
        $new = $this->productService->getNewProduct();
        $slider = $this->sliderService->getSlider();
        $cart = $this->cartService->getCartByUser();
        if ( $cart ) {
            $cart = $this->getCart($cart);
        }
        return view(
            'layouts/home',
            [
                'bestSeller' => $bestSeller,
                'new' => $new,
                'slider' => $slider,
                'cart' => $cart,
            ]
        );
    }

    public function getCart($cart)
    {
        session()->put('cart.id', $cart->id);
        session()->put('cart.vnd', $cart->vnd);
        session()->put('cart.usd', $cart->usd);
        session()->put('cart.quantity', $cart->quantity);
        session()->put('cart.discount_vnd', $cart->discount_vnd);
        session()->put('cart.discount_usd', $cart->discount_usd);
        $detail = $cart->detail;
        session()->put('cart.product', []);
        foreach ($detail as $item) {
            $productId = $item->product_id;
            $product = $item->product;
            $logo = $product->media->where('active', 1)->first();
            if ( $item ) {
                $item->logo = $logo->image_path;
                $item->name = $product->name;
                session()->put('cart.product.' . $productId, $item);
            }
        }
        $cart = session()->get('cart');

        return $cart;
    }
}
