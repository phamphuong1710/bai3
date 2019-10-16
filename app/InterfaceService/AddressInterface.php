<?php

namespace App\InterfaceService;

interface AddressInterface {
    public function createStoreAddress($storeId, $address, $lat, $lng);

    public function createUserAddress($userId, $address, $lat, $lng);

    public function updateStoreAddress($storeId, $address, $lat, $lng);

    public function updateUserAddress($userId, $address, $lat, $lng);

    public function getAddressByUserId($userId);

    public function getAddressByStoreId($storeId);
}
