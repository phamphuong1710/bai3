<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\RatingService;
use App\Service\CartService;

class SingleProductController extends Controller
{
    protected $productService;
    protected $ratingService;
    protected $cartService;

    public function __construct( ProductService $productService, RatingService $ratingService, CartService $cartService )
    {
        $this->productService = $productService;
        $this->ratingService = $ratingService;
        $this->cartService = $cartService;
    }

    public function product($slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        if (!$product) {
            abort('404');
        }
        $productStore = $this->productService->getTheSameProductInStore($product->store_id, $product->id);
        $productCategory = $this->productService->getTheSameProductInCategory($product->category, $product->id);
        $product->in_store = $productStore;
        $product->in_category = $productCategory;
        $rating = $this->ratingService->getRatingProductByUser($product->id);
        if (!$rating) {
            $rating = false;
        }
        $cart = $this->cartService->getCartByUser();
        if ( $cart ) {
            $cart = $this->getCart($cart);
        }
        $product->user_rating = $rating;

        return view(
            'layouts.product-single',
            [
                'product' => $product,
                'cart' => $cart
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
