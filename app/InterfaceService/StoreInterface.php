<?php

namespace App\InterfaceService;

interface StoreInterface {
    public function getAllStore();
    public function createStore($request);
    public function getStoreById($id);
    public function updateStore($request, $id);
    //Seach Store
    public function searchStore($request);
    // Filter Store
    public function filterStore($request);
    public function getStoreBySlug($slug);
    public function getStore();
    public function createStoreAddress($storeId, $request);
    public function updateStoreAddress($storeId, $request);
    public function getAddressByStoreID($storeId);
}
