<?php

namespace App\InterfaceService;

interface StoreInterface {
    public function getAllStore();

    public function createStore($name, $phone, $description, $userId);

    public function getStoreById($id);

    public function updateStore($name, $phone, $description, $userId, $id);

    //Seach Store
    public function searchStore($keyword, $userId);

    // Filter Store
    public function filterStore($userId, $orderby, $order);

    public function getStoreBySlug($slug);

    public function getStore();

    public function createStoreAddress($storeId, $address, $lat, $lng);

    public function updateStoreAddress($storeId, $address, $lat, $lng);

    public function getAddressByStoreID($storeId);
}
