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
        return view('admin.stores.edit');
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
        //
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
}
