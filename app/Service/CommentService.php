<?php
namespace App\Service;

use App\InterfaceService\CommentInterface;
use App\Comment;
use Auth;

class CommentService implements CommentInterface
{
    public function createProductComment($request)
    {
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->product_id = $request->product_id;
        $comment->user_id = Auth::id();
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return $comment;
    }

    public function getCommentChild($parentId)
    {
        $comments = Comment::where('parent_id', $parentId)
            ->get();

        return $comments;
    }

    public function getCommentParentProduct($productId)
    {
        $comments = Comment::where('parent_id', 0)
            ->where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

        return $comments;
    }

    public function getCommentParentStore($storeId)
    {
        $comments = Comment::where('parent_id', 0)
            ->where('store_id', $storeId)
            ->orderBy('created_at', 'desc')
            ->get();

        return $comments;
    }

    public function createStoreComment($request)
    {
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->store_id = $request->store_id;
        $comment->user_id = Auth::id();
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return $comment;
    }
}

