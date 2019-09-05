<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CommentService;
use App\Http\Requests\CommentProductRequest;
use App\Http\Requests\CommentStoreRequest;

class CommentController extends Controller
{
    protected $commentService;


    public function __construct(CommentService $commentService)
    {
        $this->middleware('auth');
        $this->commentService = $commentService;
    }

    public function createProductComment(CommentProductRequest $request)
    {
        $comment = $this->commentService->createProductComment($request);
        $html = getProductComment($comment->product_id);

        return response()->json($html);
    }

    public function createStoreComment(CommentStoreRequest $request)
    {
        $comment = $this->commentService->createStoreComment($request);
        $html = getStoreComment($comment->store_id);

        return response()->json($html);
    }
}
