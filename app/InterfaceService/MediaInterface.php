<?php

namespace App\InterfaceService;

interface MediaInterface {
    // Store
    public function createMedia($request, $storeId = null, $productId = null);
    public function getImageByStoreId($storeId);
    public function updateMedia($id, $request);
    public function deleteMedia($id);
    public function updateStoreImage($id, $storeId, $position);
    public function createVideoImage($request);
    public function createLogo($request, $storeId = null, $productId = null);
    public function getLogoByStoreId($storeId);
    public function updateProductImage($id, $productId, $position);
    public function getImageByProductId($productId);
    public function getLogoByProductId($productId);
    public function deleteOldStoreLogo($storeId, $id);
    public function deleteOldProductLogo($productId, $id);
    public function getImageByUserId($userId);
}
