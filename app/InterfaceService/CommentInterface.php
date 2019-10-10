<?php

namespace App\InterfaceService;

interface CommentInterface {
    public function createProductComment($comment, $productId, $parentId, $userId);

    public function getCommentChild($parentId);

    public function getCommentParentProduct($productId);

    public function getCommentParentStore($storeId);

    public function createStoreComment($comment, $storeId, $parentId, $userId);
}
