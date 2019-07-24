<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Service\StoreService;
use App\Service\MediaService;
use Auth;

class StoreController extends Controller
{

    protected $storeService;
    protected $mediaService;

    public function __construct(StoreService $storeService, MediaService $mediaService)
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
        $this->mediaService = $mediaService;
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
    public function store(Request $request)
    {
        $storeId = $this->storeService->createStore($request);
        $listImage = $request->list_image;
        $logo = $request->id_logo;
        $this->mediaService->updateStoreImage($logo, $storeId, null);
        $listImage = explode(',', $listImage);
        foreach ($listImage as $position => $id) {
            $this->mediaService->updateStoreImage($id, $storeId, $position);
        }

        return redirect()->route('stores.index');

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
        $store = $this->storeService->getStoreById($id);
        $image = $this->mediaService->getImageByStoreId($id);
        $logo = $this->mediaService->getLogoByStoreId($id);
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
        $this->storeService->updateStore($request, $id);
        $listImage = $request->list_image;
        $listImage = explode(',', $listImage);

        foreach ($listImage as $position => $idImage) {
            $this->mediaService->updateStoreImage($idImage, $id, $position);
        }

        return redirect()->route('stores.index');
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
        $this->storeService->deleteStore($id);
        $images = $this->mediaService->getImageByStoreId($id);
        foreach ($images as $image) {
            $this->mediaService->deleteMedia($image->id);
        }

        return redirect()->route('stores.index');
    }
}
