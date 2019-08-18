<?php

namespace App\InterfaceService;

interface ProductInterface {
    //with Pagination
    public function getAllProductStore($storeID);
    //without Pagination
    public function getAllProductInStore($storeID);
    public function getAllProductByUser($request);
    public function createProduct($request);
    public function getProductId($id);
    public function updateProduct($request, $id);
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
    public function getProductBestSeller();
    public function getNewProduct();
    public function getProductBySlug($slug);
    public function getTheSameProductInCategory($categoryId, $productId);
    public function getTheSameProductInStore($storeId, $productId);
    public function getProductDiscount($discount);
}
