<?php

namespace App\InterfaceService;

interface AddressInterface {
    public function createStoreAddress($storeId, $request);
    public function createUserAddress($userId, $request);
    public function updateStoreAddress($storeId, $request);
    public function updateUserAddress($userId, $request);
    public function searchCategory($request);
    public function filterCategory($request);
}
