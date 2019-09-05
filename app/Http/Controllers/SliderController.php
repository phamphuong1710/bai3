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
        $slider = $this->sliderService->getAllSlider();

        return view('admin.slider.list', compact('slider'));
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
            ->route('slider.index')
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->sliderService->getSliderById($id);
        $stores = $this->storeService->getStore();
        $slider->stores = $stores;

        return view('admin.slider.edit', compact('slider'));
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
        $slider = $this->sliderService->updateSlider($request, $id);

        return redirect()
            ->route('slider.index')
            ->with('update_success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderService->deleteSlider($id);

        return redirect()
            ->route('slider.index')
            ->with('update_success', 'Success deleted slider');
    }
}
