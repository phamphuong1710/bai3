<?php

namespace App\InterfaceService;

interface MediaInterface {
    // Store
    public function createMedia($fileUpload, $userId, $storeId = null, $productId = null);

    public function getImageByStoreId($storeId);

    public function updateMedia($id, $fileUpload, $userId);

    public function deleteMedia($id);

    public function updateStoreImage($id, $storeId, $position);

    public function createVideoImage($url, $userId);

    public function createLogo($logo, $userId, $storeId = null, $productId = null);

    public function getLogoByStoreId($storeId);

    public function updateProductImage($id, $productId, $position);

    public function getImageByProductId($productId);

    public function getLogoByProductId($productId);

    public function deleteOldStoreLogo($storeId, $id);

    public function deleteOldProductLogo($productId, $id);

    public function getImageByUserId($userId);

    public function insertImageInLibrary($listPath, $userId);

    public function createImageSlider($fileUpload, $userId, $sliderId = null);

    public function updateImageSlider($id, $sliderId);
}
