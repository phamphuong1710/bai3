<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\RatingService;
use App\Http\Requests\RatingRequest;
use Auth;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct( RatingService $ratingService )
    {
        $this->ratingService = $ratingService;
    }

    public function product(RatingRequest $request)
    {
        $userId = Auth::id();
        $star = (int) $request->star;
        $productId = $request->product_id;
        $rating = $this->ratingService->ratingProduct($productId, $userId, $star);

        return response()->json($rating);
    }

    public function store(RatingRequest $request)
    {
        $storeId = (int)$request->store_id;
        $star = $request->star;
        $userId = Auth::id();
        $rating = $this->ratingService->ratingStore($storeId, $userId, $star);

        return response()->json($rating);
    }
}
