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
        $comment = new Comment();
        $comment->content = $comment;
        $comment->product_id = $productId;
        $comment->user_id = $userId;
        $comment->parent_id = $parentId;
        $comment->save();
        $product = $this->productModel->findOrFail($comment->product_id);
        $product->comment_count = $product->comment_count + 1;
        $product->save();

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
        $comments = $this->commentModel->where('parent_id', 0)
            ->where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

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
        $comment = new Comment();
        $comment->content = $comment;
        $comment->store_id = $storeId;
        $comment->user_id = $userId;
        $comment->parent_id = $parentId;
        $comment->save();
        $store = Store::findOrFail($comment->store_id);
        $store->comment_count = $store->comment_count + 1;
        $store->save();

        return $comment;
    }
}

