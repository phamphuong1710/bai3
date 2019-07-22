<?php

namespace App\InterfaceService;

interface MediaInterface {
    // Store
    public function createStoreMedia($request, $storeId = null);
    public function getImageByStoreId($storeId);
    public function updateStoreMedia($id, $request);
    public function deleteStoreMedia($id);
    public function updateStoreImage($id, $storeId, $position);
}
