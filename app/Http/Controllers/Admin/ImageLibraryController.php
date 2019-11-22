<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $listPath = $this->mediaService->getImageByUserId($user);

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
