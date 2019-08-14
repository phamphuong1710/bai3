<?php
namespace App\Service;

use App\InterfaceService\CategoryInterface;
use App\Category; // model
use Carbon\Carbon;

class CategoryService implements CategoryInterface
{
    public function createCategory($request)
    {
        $category = new Category();
        $time = Carbon::now()->timestamp;
        $category->name = $request->name;
        $category->slug = str_slug( $request->name, '-' ) . $time;
        $category->parent_id = $request->parent_id;
        $category->save();

        return $category;
    }

    public function getCategoryById($id)
    {
        $category = Category::findOrFail($id);
        if(!$category) abort('404');

        return $category;
    }

    public function updateCategory($id, $request)
    {
        $category = Category::findOrFail($id);
        if(!$category) abort('404');
        $category->name = $request->name;
        $category->slug = str_slug( $request->name, '-' );
        $category->parent_id = $request->parent_id;
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

    public function searchCategory($request)
    {
        $category = Category::where('name', 'like', '%'.$request->category.'%')
            ->get();

        return $category;
    }

    public function filterCategory($request)
    {
        $category = Category::orderBy($request->order, $request->orderby)
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

