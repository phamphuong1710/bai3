<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MediaService;
use Auth;

class ImageLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $mediaService;

    public function __construct( MediaService $mediaService )
    {
        $this->middleware('auth');
        $this->mediaService = $mediaService;
    }
    public function index()
    {
        $user = Auth::id();
        $images = $this->mediaService->getImageByUserId($user);
        $listPath = [];
        foreach ($images as $image) {
            $listPath[$image->id] = $image->image_path;
        }
        $listPath = array_unique($listPath);

        return response()->json($listPath);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listPath = $request->list_path;
        $userId = Auth::id();
        $images = $this->mediaService->insertImageInLibrary($listPath, $userId);

        return response()->json($images);
    }
}
