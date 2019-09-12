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
        $comment->author = $comment->user->name;
        $comment->time = ($comment->created_at)->diffForHumans();

        return response()->json($comment);
    }

    public function createStoreComment(CommentStoreRequest $request)
    {
        $comment = $this->commentService->createStoreComment($request);
        $comment->author = $comment->user->name;
        $comment->time = ($comment->created_at)->diffForHumans();

        return response()->json($comment);
    }
}
