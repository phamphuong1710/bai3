<?php

namespace App\InterfaceService;

interface ProductInterface {
    //with Pagination
    public function getAllProductStore($storeID);
    //without Pagination
    public function getAllProductInStore($storeID);
    public function createProduct($request);
    public function getProductId($id);
    public function updateProduct($request, $id);
    public function deleteProduct($id);
    //Seach Product In Store
    public function searchProduct($request);
    // Filter Product By Category In Store
    public function filterProductByCategory($request);
    //Search Product By User
    public function searchProductByUser($request);
}
