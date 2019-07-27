<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\MediaService;
use App\Service\CategoryService;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request);
        $logo = $request->id_logo;
        $this->mediaService->updateProductImage($logo, $product->id, null);
        $listImage = $request->list_image;
        $listImage = explode(',', $listImage);
        foreach ($listImage as $position => $id) {
            $this->mediaService->updateProductImage($id, $product->id, $position);
        }

        return redirect()
            ->route('stores.show', [ 'id' => $request->store_id ] )
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
        //
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
        $images = $this->mediaService->getImageByProductId($id);
        $logo = $this->mediaService->getLogoByProductId($id);
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
    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($request, $id);

        return redirect()
            ->route('stores.show', [ 'id' => $request->store_id ] )
            ->with('success_update', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createProduct($storeId)
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
}
