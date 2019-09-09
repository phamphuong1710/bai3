<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\MediaService;
use App\Service\CategoryService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $mediaService;
    protected $categoryService;

    public function __construct(
        ProductService $productService,
        MediaService $mediaService,
        CategoryService $categoryService
    )
    {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->mediaService = $mediaService;
        $this->categoryService = $categoryService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function product()
    {
        $categories = $this->categoryService->allCategory();

        return view(
            'admin.product.create',
            [
                'categories' => $categories,
                'store_id' => $storeId
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        $logo = $request->logo_id;
        $this->mediaService->updateProductImage($logo, $product->id, null);
        $listImage = $request->list_image;
        $listImage = explode(',', $listImage);
        foreach ($listImage as $position => $id) {
            $this->mediaService->updateProductImage($id, $product->id, $position);
        }

        return redirect()
            ->route('stores.show', [ 'id' => $product->store_id ] )
            ->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.product.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->getProductId($id);
        $categories = $this->categoryService->allCategory();
        $logo = $this->mediaService->getLogoByProductId($id);
        $images = $this->mediaService->getImageByProductId($id);
        $listImage = [];
        foreach ($images as $image) {
            array_push($listImage, $image->id);
        }
        $listImage = implode(',', $listImage);
        $product->list_image = $listImage;
        $product->categories = $categories;
        $product->images = $images;
        $product->logo = $logo->image_path;
        $product->logo_id = $logo->id;

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        dd($product);
        $product = $this->productService->updateProduct($request, $id);
        $listImage = $request->list_image;
        $logo = $request->logo_id;
        if (!empty($logo)) {
            $this->mediaService->updateProductImage($logo, $id, null);
            $this->mediaService->deleteOldProductLogo($id, $logo);
        }
        if ( ! empty( $listImage ) ) {
            $listImage = explode(',', $listImage);
            foreach ($listImage as $position => $idImage) {
                $this->mediaService->updateProductImage($idImage, $id, $position);
            }
        }

        return redirect()
            ->route('stores.show', [ 'id' => $product->store_id ] )
            ->with('success_update_product', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->deleteProduct($id);

        return response()->json($product);
    }

    /**
     * Create Product In Store
     */
    public function createProduct($storeId)
    {
        $categories = $this->categoryService->allCategory();

        return view(
            'admin.stores.create-product',
            [
                'categories' => $categories,
                'store_id' => $storeId,
            ]
        );
    }

    public function getAllProductByUser()
    {
        $categories = $this->categoryService->allCategory();
        $products = $this->productService->getProductByUser();
        $products->categories = $categories;

        return view(
            'admin.product.list',
            [
                'categories' => $categories,
                'products' => $products,
            ]
        );
    }
}
