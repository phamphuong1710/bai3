<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\RatingService;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct( RatingService $ratingService )
    {
        $this->ratingService = $ratingService;
    }

    public function product(Request $request)
    {
        $rating = $this->ratingService->ratingProduct($request);

        return response()->json($rating);
    }

    public function store(Request $request)
    {
        $rating = $this->ratingService->ratingStore($request);

        return response()->json($rating);
    }
}
