<?php

namespace App\Service;

use App\InterfaceService\AddressInterface;
use App\Address;

class AddressService implements AddressInterface
{
    protected $addressModel;

    public function __construct(Address $addressModel)
    {
        $this->addressModel = $addressModel;
    }

    public function createStoreAddress($storeId, $address, $lat, $lng)
    {
        $address = new Address();
        $address->address = $address;
        $address->lat = $lat;
        $address->lng = $lng;
        $address->store_id = $storeId;
        $address->active = 1;
        $address->save();

        return $address;
    }

    public function getAddressByStoreId($storeId)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', 1)
            ->firstOrFail();

        return $address;
    }

    public function updateStoreAddress($storeId, $address, $lat, $lng)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', 1)
            ->firstOrFail();
        $address->address = $address;
        $address->lat = $lat;
        $address->lng = $lng;
        $address->save();

        return $address;
    }

    public function createUserAddress($userId, $address, $lat, $lng)
    {
        $address = new Address();
        $address->address = $address;
        $address->lat = $lat;
        $address->lng = $lng;
        $address->user_id = $userId;
        $address->active = 1;
        $address->save();

        return $address;
    }

    public function updateUserAddress($userId,  $address, $lat, $lng)
    {
        $address = $this->addressModel->where('user_id', $userId)
            ->where('active', 1)
            ->firstOrFail();
        $address->address = $address;
        $address->lat = $lat;
        $address->lng = $lng;
        $address->save();

        return $address;
    }


    public function getAddressByUserId($userId)
    {
        $address = $this->addressModel->where('user_id', $userId)
            ->where('active', 1)
            ->firstOrFail();

        return $address;
    }
}
