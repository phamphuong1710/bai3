<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\HomeService;
use App\Service\CartService;
use App\Service\UserService;
use Auth;

class HomeController extends Controller
{
    protected $homeService;
    protected $cartService;

    public function __construct( HomeService $homeService, CartService $cartService, UserService $userService )
    {
        $this->homeService = $homeService;
        $this->cartService = $cartService;
        $this->userService = $userService;
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
        $bestSeller = $this->homeService->getProductBestSeller();
        foreach ($bestSeller as $index => $product) {
            $bestSeller[$index]->logo = $product->media->where('active', 1)->first();
        }
        $new = $this->homeService->getNewProduct();
        foreach ($new as $index => $product) {
            $new[$index]->logo = $product->media->where('active', 1)->first();
        }
        $slider = $this->homeService->getSlider();
        $userId = Auth::id();
        $cart = $this->cartService->getCartByUser($userId);
        if ( $cart ) {
            $cart = $this->getCart($cart);
        }
        $storeBestSeller = $this->homeService->getStoreBestSeller();
        foreach ($storeBestSeller as $key => $store) {
            $storeBestSeller[$key]->logo = $store->media->where('active', 1)->first();
        }
        $storeRating = $this->homeService->getTopStoreRating();
        foreach ($storeRating as $key => $store) {
            $storeRating[$key]->logo = $store->media->where('active', 1)->first();
        }

        return view(
            'layouts/home',
            [
                'bestSeller' => $bestSeller,
                'new' => $new,
                'slider' => $slider,
                'cart' => $cart,
                'storeSale' => $storeBestSeller,
                'storeRating' => $storeRating,
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
