<?php

namespace App\InterfaceService;

interface CommentInterface {
    public function createProductComment($request);
    public function getCommentChild($parentId);
    public function getCommentParentProduct($productId);
    public function getCommentParentStore($storeId);
    public function createStoreComment($request);
}
