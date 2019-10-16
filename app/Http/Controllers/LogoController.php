<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MediaService;
use Auth;

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
        $logo = $request->file('logo');
        $userId = Auth::id();
        $logo = $this->mediaService->createLogo($logo, $userId);

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
        $fileUpload = $request->file('logo');
        $userId = Auth::id();
        $image = $this->mediaService->createImageSlider($fileUpload, $userId);

        return response()->json($image);
    }
}
