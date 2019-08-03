<?php

namespace App\InterfaceService;

interface StoreInterface {
    public function getAllStore();
    public function createStore($request);
    public function getStoreById($id);
    public function updateStore($request, $id);
    //Seach Store
    public function searchStore($request);
}
