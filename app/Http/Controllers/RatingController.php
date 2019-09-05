<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\RatingService;
use App\Http\Requests\RatingRequest;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct( RatingService $ratingService )
    {
        $this->ratingService = $ratingService;
    }

    public function product(RatingRequest $request)
    {
        $rating = $this->ratingService->ratingProduct($request);

        return response()->json($rating);
    }

    public function store(RatingRequest $request)
    {
        $rating = $this->ratingService->ratingStore($request);

        return response()->json($rating);
    }
}
