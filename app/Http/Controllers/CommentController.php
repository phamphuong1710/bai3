<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\CommentService;
use App\Http\Requests\CommentProductRequest;
use App\Http\Requests\CommentStoreRequest;
use Auth;

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
        $userId = Auth::id();
        $productId = (int)$request->product_id;
        $parentId = (int)$request->parent_id;
        $content = $request->comment;
        $comment = $this->commentService->createProductComment($content, $productId, $parentId, $userId);


        return response()->json($comment);
    }

    public function createStoreComment(CommentStoreRequest $request)
    {
        $userId = Auth::id();
        $storeId = $request->store_id;
        $parentId = $request->parent_id;
        $comment = $request->comment;
        $comment = $this->commentService->createStoreComment($comment, $storeId, $parentId, $userId);
        $comment->author = $comment->user->name;
        $comment->time = ($comment->created_at)->diffForHumans();

        return response()->json($comment);
    }
}
