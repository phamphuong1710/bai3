<?php
namespace App\Service;

use App\InterfaceService\StoreInterface;
use App\Store; // model

class StoreService implements StoreInterface
{

    public function getAllStore()
    {
        $stores = Store::paginate(15);

        return $stores;
    }

    public function createStore($request)
    {
        $store = new Store();
        $store->name = $request->name;
        $store->slug = str_slug($request->name, '-');
        $store->phone = $request->phone;
        $store->description = $request->description;
        $store->user_id = $request->user_id;
        $store->save();

        return $store;
    }

    public function getStoreById($id)
    {
        $store = Store::findOrFail($id);

        return $store;
    }

    public function updateStore($request, $id)
    {
        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->slug = str_slug($request->name, '-');
        $store->phone = $request->phone;
        $store->description = $request->description;
        $store->user_id = $request->user_id;
        $store->save();

        return $store;
    }

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        Store::destroy($id);

        return $store;
    }

    public function getStoreByUser($userId)
    {
        $stores = Store::all();

        return $stores;
    }

    //Seach Store
    public function searchStore($request)
    {
        $stores = Store::where('name', 'like', '%'.$request->store.'%')->get();

        return $stores;
    }
}

