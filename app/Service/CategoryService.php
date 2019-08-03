<?php
namespace App\Service;

use App\InterfaceService\CategoryInterface;
use App\Category; // model

class CategoryService implements CategoryInterface
{
    public function createCategory($request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug( $request->name, '-' );
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
        $categories = Category::all();

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
}

