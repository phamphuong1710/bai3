<?php

namespace App\InterfaceService;

interface CategoryInterface {
    public function createCategory($request);
    public function getCategoryById($id);
    public function updateCategory($id, $request);
    public function deleteCategory($id);
    public function getCategoryStore($listCategory);
    public function getChildCategory($parentId);
    public function searchCategory($request);
    public function filterCategory($request);
    public function getParentCategory();
}
