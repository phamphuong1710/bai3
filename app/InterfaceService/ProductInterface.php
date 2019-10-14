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

    //Seach Product In Store
    public function searchProduct($request);

    // Filter Product By Category In Store
    public function filterProductByCategory($request, $listCategory);

    //Search Product By User
    public function searchProductByUser($request);

    // Filter Product By Category By User
    public function filterProductByUserCategory($request, $listCategory);

    // Filter All Product In Store
    public function filterAllProductStore($request);

    public function getProductBySlug($slug);

    public function getTheSameProductInCategory($categoryId, $productId);

    public function getTheSameProductInStore($storeId, $productId);

    public function getProductDiscount($discount);

    public function getProductByCategoryInStore($storeId, $categoryId);
}
