<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\StoreService;
use App\Service\RatingService;
use App\Service\CommentService;
use App\Service\CategoryService;

class StoreSingleController extends Controller
{
    protected $storeService;
    protected $commentService;
    protected $ratingService;
    protected $categoryService;

    public function __construct(
        CommentService $commentService,
        StoreService $storeService,
        RatingService $ratingService,
        CategoryService $categoryService
    )
    {
        $this->storeService = $storeService;
        $this->commentService = $commentService;
        $this->ratingService = $ratingService;
        $this->categoryService = $categoryService;
    }

    public function store($slug)
    {
        $store = $this->storeService->getStoreBySlug($slug);
        $categories = $this->getCategories($store);
        $products = $this->getProducts($store, $categories);
        $store->categories = $categories;
        $rating = $this->ratingService->getRatingStoreByUser($store->id);
        if (!$rating) {
            $rating = false;
        }
        $store->user_rating = $rating;
        $commentsParent = $this->commentService->getCommentParentStore($store->id);
        $commentsChild = [];
        foreach ($commentsParent as $comment) {
            $commentsChild[$comment->id] = $this->commentService->getCommentChild($comment->id);
        }

        return view(
            'layouts.store',
            [
                'store' => $store,
                'comments_parent' => $commentsParent,
                'comments_child' => $commentsChild,
                'products' => $products,
            ]
        );
    }

    public function getCategories($store)
    {
        $products = $store->products;
        $listCategory = [];
        foreach ($products as $product) {
            $categoryId = $product->category_id;
            if ( !in_array($categoryId, $listCategory) ) {
                array_push($listCategory, $categoryId);
            }
        }
        $categories = $this->categoryService->getCategoryStore($listCategory);

        return $categories;
    }

    public function getProducts($store, $categories)
    {
        $products = [];
        foreach ($categories as $category) {
            $products[$category->id] = $category->products->where('store_id', $store->id);
        }

        return $products;
    }
}
