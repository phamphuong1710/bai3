<?php

namespace App\Service;

use App\InterfaceService\AddressInterface;
use App\Address;

class AddressService implements AddressInterface
{
    public function createStoreAddress($storeId, $request)
    {
        $address = new Address();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->store_id = $storeId;
        $address->active = 1;
        $address->save();

        return $address;
    }

    public function getAddressByStoreID($storeId)
    {
        $address = Address::where('store_id', $storeId)
            ->where('active', 1)
            ->firstOrFail();

        return $address;
    }

    public function updateStoreAddress($storeId, $request)
    {
        $address = Address::where('store_id', $storeId)
            ->where('active', 1)
            ->firstOrFail();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->save();

        return $address;
    }

    public function createUserAddress($userId, $request)
    {
        $address = new Address();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->user_id = $userId;
        $address->active = 1;
        $address->save();

        return $address;
    }

    public function updateUserAddress($userId, $request)
    {
        $address = Address::where('user_id', $userId)
            ->where('active', 1)
            ->firstOrFail();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->save();

        return $address;
    }


    public function getAddressByUserID($userId)
    {
        $address = Address::where('user_id', $userId)
            ->where('active', 1)
            ->firstOrFail();

        return $address;
    }
}
