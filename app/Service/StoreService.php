<?php
namespace App\Service;

use App\InterfaceService\StoreInterface;
use App\Store;
use App\Address; // model
use Auth;

class StoreService implements StoreInterface
{

    public function getAllStore()
    {
        $stores = Store::paginate(9);

        return $stores;
    }

    public function getStore()
    {
        $stores = Store::orderBy('name', 'asc')
            ->get();

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
        $user = Auth::id();
        $stores = Store::where('name', 'like', '%'.$request->store.'%')
            ->orwhere('description', 'like', '%'.$request->store.'%')
            ->where('user_id', $user)
            ->get();

        return $stores;
    }

    // Filter Store
    public function filterStore($request)
    {
        $user = Auth::id();
        $stores = Store::where('user_id', $user)
            ->orderBy($request->order, $request->orderby)
            ->get();

        return $stores;
    }

    public function getTopDiscountStore($listStore)
    {
        $stores = Store::whereIn('id', $listStore)
            ->get();

        return $stores;
    }

    public function getStoreBySlug($slug)
    {
        $store = Store::where('slug', $slug)->first();

        return $store;
    }

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

    public function getAddressByStoreID($storeId)
    {
        $address = Address::where('store_id', $storeId)
            ->where('active', 1)
            ->firstOrFail();

        return $address;
    }
}

