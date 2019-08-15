<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MediaService;

class LogoController extends Controller
{
    protected $mediaService;

    public function __construct( MediaService $mediaService )
    {
        $this->middleware('auth');
        $this->mediaService = $mediaService;
    }

    public function store(Request $request)
    {
        $logo = $this->mediaService->createLogo($request, null, null);

        return response()->json($logo);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->mediaService->deleteMedia($id);
    }

    public function createImageSlider(Request $request)
    {
        $image = $this->mediaService->createImageSlider($request);

        return response()->json($image);
    }
}
