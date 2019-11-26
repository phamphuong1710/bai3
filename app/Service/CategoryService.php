<?php
namespace App\Service;

use App\InterfaceService\CategoryInterface;
use App\Category; // model
use Carbon\Carbon;

class CategoryService implements CategoryInterface
{

    public function createCategory($name, $parentId)
    {
        $category = new Category();
        $time = Carbon::now()->timestamp;
        $category->name = $name;
        $category->slug = str_slug( $name, '-' ) . $time;
        $category->parent_id = $parentId;
        $category->save();

        return $category;
    }

    public function getCategoryById($id)
    {
        $category = Category::findOrFail($id);
        if ( $category->media ) {
            $media = $category->media->where( 'active', 1 )->first();
            if ( $media ) {
                $category->logo = $media->image_path;
                $category->logo_id = $media->id;
            }
        }
        if(!$category) abort('404');

        return $category;
    }

    public function updateCategory($id, $name, $parentId)
    {
        $category = Category::findOrFail($id);
        if(!$category) abort('404');
        $category->name = $name;
        $category->slug = str_slug( $name, '-' );
        $category->parent_id = $parentId;
        $category->save();

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
       Category::where('id', $id)->delete();

        return $category;
    }

    public function allCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        foreach ($categories as $index => $category) {
            if ( $category->media ) {
                $media = $category->media->where( 'active', 1 )->first();
                if ( $media ) {
                    $category->logo = $media->image_path;
                    $category->logo_id = $media->id;
                }
            }
        }

        return $categories;
    }

    public function getCategoryStore($listCategory)
    {
        $categories = Category::whereIn('id',$listCategory)->get();

        return $categories;
    }

    public function getChildCategory($parentId)
    {
        $categories = Category::where('parent_id', $parentId)->get();

        return $categories;
    }

    public function searchCategory($key)
    {
        $category = Category::where('name', 'like', '%' . $key . '%')
            ->get();

        return $category;
    }

    public function filterCategory($orderBy, $order)
    {
        $category = Category::orderBy($orderBy, $order)
            ->get();

        return $category;
    }

    public function getParentCategory()
    {
        $categories = Category::where('parent_id', 0)->paginate(8);
        return $categories;
    }

    public function getCategoryBySlug($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return $category;
    }
}

