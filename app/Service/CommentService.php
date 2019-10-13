<?php
namespace App\Service;

use App\InterfaceService\CommentInterface;
use App\Comment;
use App\Product;
use App\Store;

class CommentService implements CommentInterface
{
    protected $commentModel;
    protected $productModel;
    protected $storeModel;

    public function __construct(Comment $commentModel, Product $productModel, Store $storeModel)
    {
        $this->commentModel = $commentModel;
        $this->productModel = $productModel;
        $this->storeModel = $storeModel;
    }

    public function createProductComment($comment, $productId, $parentId, $userId)
    {
        $args = [
            'content' => $comment,
            'product_id' => $productId,
            'user_id' => $userId,
            'parent_id' => $parentId,
        ];
        $comment = $this->commentModel->create($args);
        $product = $this->productModel->findOrFail($productId);
        $counter = $product->comment_count + 1;
        $product = $this->productModel->where('id', $productId)
            ->update(['comment_count' => $counter]);
        $comment->author = $comment->user->name;
        $comment->time = ($comment->created_at)->diffForHumans();

        return $comment;
    }

    public function getCommentChild($parentId)
    {
        $comments = $this->commentModel->where('parent_id', $parentId)
            ->get();

        return $comments;
    }

    public function getCommentParentProduct($productId)
    {
        $condition = [
            [ 'parent_id', '=', 0],
            [ 'product_id', '=', $productId ],
        ];
        $comments = Comment::where($condition)->orderBy('created_at', 'desc')->get();

        return $comments;
    }

    public function getCommentParentStore($storeId)
    {
        $comments = $this->commentModel->where('parent_id', 0)
            ->where('store_id', $storeId)
            ->orderBy('created_at', 'desc')
            ->get();

        return $comments;
    }

    public function createStoreComment($comment, $storeId, $parentId, $userId)
    {
        $args = [
            'content' => $comment,
            'store_id' => $storeId,
            'user_id' => $userId,
            'parent_id' => $parentId,
        ];
        $comment = $this->commentModel->create($args);
        $store = $this->storeModel->findOrFail($storeId);
        $counter = $store->comment_count + 1;
        $store = $this->storeModel->where('id', $storeId)
            ->update(['comment_count' => $counter]);
        $comment->author = $comment->user->name;
        $comment->time = ($comment->created_at)->diffForHumans();

        return $comment;
    }
}

