<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service\HomeService;
use App\Service\CartService;
use App\Service\StoreService;
use App\Service\SliderService;
use Auth;

class HomeController extends Controller
{
    protected $slideService;
    protected $storeService;
    protected $cartService;
    public function __construct( SliderService $slideService, CartService $cartService, StoreService $storeService )
    {
        $this->slideService = $slideService;
        $this->storeService = $storeService;
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
        $slider = $this->slideService->getSlider();
        $userId = Auth::id();
        $cart = $this->cartService->getCartByUser($userId);
        if ( $cart ) {
            $cart = $this->getCart($cart);
        }
        $stores = $this->storeService->getAllStore();
        foreach ($stores as $key => $store) {
            $stores[$key]->logo = $store->media->where('active', 1)->first();
        }

        return view(
            'layouts/home',
            [
                'slider' => $slider,
                'cart' => $cart,
                'stores' => $stores,
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
