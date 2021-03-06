<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Service\StoreService;
use App\Service\MediaService;
use App\Service\ProductService;
use App\Service\UserService;
use App\Service\CategoryService;
use Auth;

class StoreController extends BaseController
{

    protected $storeService;
    protected $mediaService;
    protected $productService;
    protected $userService;
    protected $categoryService;

    public function __construct(
        StoreService $storeService,
        MediaService $mediaService,
        ProductService $productService,
        UserService $userService,
        CategoryService $categoryService
    )
    {
        $this->middleware('auth');
        parent::__construct($userService);
        $this->storeService = $storeService;
        $this->mediaService = $mediaService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->middleware('permission:store-create', ['only' => ['create','store']]);
        $this->middleware('permission:store-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:store-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->storeService->getAllStore();

        return view('admin.stores.list', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $description = $request->description;
        $userId = Auth::id();
        $store = $this->storeService->createStore($name, $phone, $description, $userId);
        $storeId = $store->id;
        $listImage = $request->list_image;
        $logo = $request->logo_id;
        $this->mediaService->updateStoreImage($logo, $storeId);
        $listImage = explode(',', $listImage);
        foreach ($listImage as $position => $id) {
            $this->mediaService->updateStoreImage($id, $storeId, $position);
        }
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $this->storeService->createStoreAddress($storeId, $address, $lat, $lng);

        return redirect()
        ->route('stores.index')
        ->with('success_store','Store created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = $this->storeService->getStoreById($id);
        $images = $this->mediaService->getImageByStoreId($id);
        $listImage = [];
        foreach ($images as $image) {
            array_push($listImage, $image->id);
        }
        $listImage = implode(',', $listImage);
        $products = $this->productService->getAllProductStore($id);
        $store->products = $products;
        $address = $this->storeService->getAddressByStoreId($id);
        $store->list_image = $listImage;
        $products = $this->productService->getAllProductInStore($id);
        $listCategory = [];
        $categories = [];
        if (!empty($products)) {
            foreach ($products as $product) {
                array_push($listCategory, $product->category_id);
            }
            $listCategory = array_unique($listCategory);
            $categories = $this->categoryService->getCategoryStore($listCategory);
        }

        return view(
            'admin.stores.info',
            [
                'store' => $store,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = $this->storeService->getStoreById($id);
        $image = $this->mediaService->getImageByStoreId($id);
        $logo = $this->mediaService->getLogoByStoreId($id);
        $address = $this->storeService->getAddressByStoreId($id);
        $store->address = $address;
        $store->media = $image;
        $store->logo = $logo->image_path;
        $store->logo_id = $logo->id;

        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $phone = $request->phone;
        $description = $request->description;
        $userId = Auth::id();
        $this->storeService->updateStore($name, $phone, $description, $userId, $id);
        $listImage = $request->list_image;
        $logo = $request->logo_id;
        if (!empty($logo)) {
            $this->mediaService->updateStoreImage($logo, $id, null);
            $this->mediaService->deleteOldStoreLogo($id, $logo);
        }
        if ( !empty($listImage) ) {
            $listImage = explode(',', $listImage);
            foreach ($listImage as $position => $idImage) {
                $this->mediaService->updateStoreImage($idImage, $id, $position);
            }
        }
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $this->storeService->updateStoreAddress($id, $address, $lat, $lng);

        return redirect()
            ->route('stores.index')
            ->with('update_store','Store updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storeId = $id;
        $store = $this->storeService->deleteStore($id);
        $images = $this->mediaService->getImageByStoreId($id);
        foreach ($images as $image) {
            $this->mediaService->deleteMedia($image->id);
        }

        return response()->json($store);
    }
}
