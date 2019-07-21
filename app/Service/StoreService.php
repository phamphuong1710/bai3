<?php
namespace App\Service;

use App\InterfaceService\StoreInterface;
use App\Store; // model

class StoreService implements StoreInterface
{
    public function createCategory($request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug( $request->name, '-' );

        $category->save();
    }

    public function getCategoryById($id)
    {
        $category = Category::find($id);
        if(!$category) abort('404');

        return $category;
    }

    public function updateCategory($id, $request)
    {
        $category = Category::find($id);
        if(!$category) abort('404');
        $category->name = $request->name;
        $category->slug = str_slug( $request->name, '-' );

        $category->save();
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
    }

    public function getAllStore()
    {
        $categories = Store::all();

        return $categories;
    }
}

