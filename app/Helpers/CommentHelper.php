<?php
use App\Service\CommentService;
use App\Service\ProductService;
use App\Service\StoreService;

if (!function_exists('getProductComment')) {
    function getProductComment($productId)
    {
        $query = new CommentService();
        $products = new ProductService();
        $comments = $query->getCommentParentProduct($productId);
        $product = $products->getProductId($productId);
        $html = '<h3 class="comment-count">' . $product->comments->count() . ' comment</h3>';
        if ( $comments ) {
            foreach ($comments as $comment) {
                $html .= '<ul class="comments">
                            <li class="comment-item">
                                <div class="comment-info">
                                    <div class="comment-info-left">
                                        <span class="author">'.$comment->user->name.'</span>
                                        <span class="created-at ion-clock">'.($comment->created_at)->diffForHumans().'</span>
                                    </div>
                                    <a href="#" class="reply-comment ion-chatbubble" comment="'.$comment->id.'">Reply</a>
                                </div>
                                <span class="comment-content">'.$comment->content.'
                                </span>
                                <div class="reply-form"></div>
                            </li>'
                            .getCommentChild($comment->id).
                            '</ul>';
            }
        }

        return $html;
    }
}

if (!function_exists('getCommentChild')) {
    function getCommentChild($parentId)
    {
        $query = new CommentService();
        $comments = $query->getCommentChild($parentId);
        $html = '';
        if ($comments) {
            foreach ($comments as $comment) {
                $html .= '<ul class="list-child-comment">
                            <li class="comment-item">
                                <div class="comment-info">
                                    <div class="comment-info-left">
                                        <span class="author">'.$comment->user->name.'</span>
                                        <span class="created-at ion-clock">'.
                                            ($comment->created_at)->diffForHumans().
                                        '</span>
                                    </div>
                                    <a href="#" class="reply-comment ion-chatbubble" comment="'.$comment->id.'">Reply</a>
                                </div>
                                <span class="comment-content ">'.$comment->content.'
                                </span>
                                <div class="reply-form"></div>
                            </li>'.
                                getCommentChild($comment->id).
                        '</ul>';
            }
        }

        return $html;
    }
}

if (!function_exists('getStoreComment')) {
    function getStoreComment($storeId)
    {
        $query = new CommentService();
        $stores = new StoreService();
        $comments = $query->getCommentParentStore($storeId);
        $store = $stores->getStoreById($storeId);
        $html = '<h3 class="comment-count">' . $store->comments->count() . ' comment</h3>';
        if ( $comments ) {
            foreach ($comments as $comment) {
                $html .= '<ul class="comments">
                            <li class="comment-item">
                                <div class="comment-info">
                                    <div class="comment-info-left">
                                        <span class="author">'.$comment->user->name.'</span>
                                        <span class="created-at ion-clock">'.($comment->created_at)->diffForHumans().'</span>
                                    </div>
                                    <a href="#" class="reply-comment ion-chatbubble" comment="'.$comment->id.'">Reply</a>
                                </div>
                                <span class="comment-content">'.$comment->content.'
                                </span>
                                <div class="reply-form"></div>
                            </li>'
                            .getCommentChild($comment->id).
                            '</ul>';
            }
        }

        return $html;
    }
}

