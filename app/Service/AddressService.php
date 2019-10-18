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
        $address->active = env('ACTIVE');
        $address->save();

        return $address;
    }

    public function getAddressByStoreId($storeId)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', env('ACTIVE'))
            ->firstOrFail();

        return $address;
    }

    public function updateStoreAddress($storeId, $address, $lat, $lng)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', env('ACTIVE'))
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
        $address->active = env('ACTIVE');
        $address->save();

        return $address;
    }

    public function updateUserAddress($userId,  $address, $lat, $lng)
    {
        $active = env('ACTIVE');
        $address = $this->addressModel->where('user_id', $userId)
            ->where('active', $active)
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
            ->where('active', env('ACTIVE'))
            ->firstOrFail();

        return $address;
    }
}
