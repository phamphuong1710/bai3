<?php

namespace App\InterfaceService;

interface ProductInterface {
    public function getAllProduct();

    //with Pagination
    public function getAllProductStore($storeID);

    //without Pagination
    public function getAllProductInStore($storeID);

    public function getAllProductByUser($userId, $order, $orderby);

    public function createProduct($name, $storeId, $categoryId, $description, $userId, $quantity, $onSale, $usdToVnd, $salePrice, $cost);

    public function getProductId($id);

    public function updateProduct($name, $storeId, $categoryId, $description, $userId, $quantity, $onSale, $usdToVnd, $salePrice, $cost, $id);

    public function deleteProduct($id);


    // Filter Product By Category In Store
    public function filterProductByCategory($storeId, $order, $orderby, $categoryId);

    //Search Product By User
    public function searchProductByUser($request);

    // Filter Product By Category By User
    public function filterProductByUserCategory($request, $listCategory, $userId);

    public function getProductBySlug($slug);

    public function getTheSameProductInCategory($categoryId, $productId);

    public function getTheSameProductInStore($storeId, $productId);

    public function getProductDiscount($discount);

    public function getProductByCategoryInStore($storeId, $categoryId);
}
