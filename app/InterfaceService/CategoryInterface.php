<?php

namespace App\InterfaceService;

interface CategoryInterface {
    public function createCategory($name, $parentId);

    public function getCategoryById($id);

    public function updateCategory($id, $name, $parentId);

    public function deleteCategory($id);

    public function getCategoryStore($listCategory);

    public function getChildCategory($parentId);

    public function searchCategory($key);

    public function filterCategory($orderBy, $order);

    public function getParentCategory();

    public function getCategoryBySlug($slug);
}
