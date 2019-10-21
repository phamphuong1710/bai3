<?php
namespace App\Service;

use App\InterfaceService\StoreInterface;
use App\Store;
use App\Address; // model
use Auth;

class StoreService implements StoreInterface
{
    protected $addressModel;
    protected $storeModel;

    public function __construct(Store $storeModel, Address $addressModel)
    {
        $this->storeModel = $storeModel;
        $this->addressModel = $addressModel;
    }

    public function getAllStore()
    {
        $stores = $this->storeModel->paginate(9);

        return $stores;
    }

    public function getStore()
    {
        $stores = $this->storeModel->orderBy('name', 'asc')
            ->get();

        return $stores;
    }

    public function createStore($name, $phone, $description, $userId)
    {
        $store = new Store();
        $store->name = $name;
        $store->slug = str_slug($name, '-');
        $store->phone = $phone;
        $store->description = $description;
        $store->user_id = $userId;
        $store->save();

        return $store;
    }

    public function getStoreById($id)
    {
        $store = Store::findOrFail($id);

        return $store;
    }

    public function updateStore($name, $phone, $description, $userId, $id)
    {
        $store = $this->storeModel->findOrFail($id);
        $store->name = $name;
        $store->slug = str_slug($name, '-');
        $store->phone = $phone;
        $store->description = $description;
        $store->user_id = $userId;
        $store->save();

        return $store;
    }

    public function deleteStore($id)
    {
        $store = $this->storeModel->findOrFail($id);
        $this->storeModel->destroy($id);

        return $store;
    }

    public function getStoreByUser($userId)
    {
        $stores = $this->storeModel->all();

        return $stores;
    }

    //Seach Store
    public function searchStore($keyword, $userId)
    {
        $stores = $this->storeModel->where('name', 'like', '%' . $request->store.'%')
            ->orwhere('description', 'like', '%' . $request->store . '%')
            ->where('user_id', $userId)
            ->get();
        foreach ($stores as $index => $store) {
            $stores[$index]->logo = $store->media->where('active', env('ACTIVE'))->first();
            $stores[$index]->address = $store->address->address;
        }

        return $stores;
    }

    // Filter Store
    public function filterStore($userId, $orderby, $order)
    {
        $user = Auth::id();
        $stores = $this->storeModel->where('user_id', $user)
            ->orderBy($orderby, $order)
            ->get();
        foreach ($stores as $index => $store) {
            $stores[$index]->logo = $store->media->where('active', 1)->first();
            $stores[$index]->address = $store->address->address;
        }

        return $stores;
    }

    public function getTopDiscountStore($listStore)
    {
        $stores = $this->storeModel->whereIn('id', $listStore)
            ->get();

        return $stores;
    }

    public function getStoreBySlug($slug)
    {
        $store = $this->storeModel->where('slug', $slug)->first();

        return $store;
    }

    public function createStoreAddress($storeId, $address, $lat, $lng)
    {
        $address = new Address();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->store_id = $storeId;
        $address->active = env('ACTIVE');
        $address->save();

        return $address;
    }

    public function updateStoreAddress($storeId, $address, $lat, $lng)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', env('ACTIVE'))
            ->firstOrFail();
        $address->address = $request->address;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->save();

        return $address;
    }

    public function getAddressByStoreID($storeId)
    {
        $address = $this->addressModel->where('store_id', $storeId)
            ->where('active', env('ACTIVE'))
            ->firstOrFail();

        return $address;
    }
}

