<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\StoreService;
use App\Service\MediaService;
use App\Service\SliderService;

class SliderController extends Controller
{
    protected $storeService;
    protected $mediaService;
    protected $categoryService;

    public function __construct(
        StoreService $storeService,
        MediaService $mediaService,
        SliderService $sliderService
    )
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
        $this->mediaService = $mediaService;
        $this->sliderService = $sliderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = $this->storeService->getStore();

        return view('admin.slider.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = $this->sliderService->createSlider($request);
        $image = $request->logo_id;
        $this->mediaService->updateImageSlider($image, $slide->id);

        return redirect()
            ->view('layout.home')
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
        //
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
