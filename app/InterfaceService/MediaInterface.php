<?php

namespace App\InterfaceService;

interface MediaInterface {
    // Store
    public function createStoreMedia($request, $storeId = null);
    public function getImageByStoreId($storeId);
    public function updateMedia($id, $request);
    public function deleteMedia($id);
    public function updateStoreImage($id, $storeId, $position);
    public function createVideoImage($request);
    public function createStoreLogo($request, $storeId = null);
    public function getLogoByStoreId($storeId);
    public function updateLogoStore($id, $request);
}
