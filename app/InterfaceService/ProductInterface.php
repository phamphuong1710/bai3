<?php

namespace App\InterfaceService;

interface ProductInterface {
    public function getAllProductStore($storeID);
    public function createProduct($request);
    public function getProductId($id);
    public function updateProduct($request, $id);
    public function deleteProduct($id);
}
