<?php

use App\Service\StoreService;
use App\Service\MediaService;
use App\Service\ProductService;
use App\Service\AddressService;
use App\Service\CategoryService;

if ( !function_exists( 'getStoreLogo' ) ) {
    function getStoreLogo($storeId)
    {
        $media = new MediaService();
        $logo = $media->getLogoByStoreId($storeId);

        return $logo;
    }
}

if ( !function_exists( 'getStoreLogoPath' ) ) {
    function getStoreLogoPath($storeId)
    {
        $logo = getStoreLogo($storeId);

        return $logo->image_path;
    }
}

if ( !function_exists( 'getListImageStore' ) ) {
    function getListImageStore($storeId)
    {
        $media = new MediaService();
        $images = $media->getImageByStoreId($storeId);
        $listImage = [];
        foreach ($images as $image) {
            array_push($listImage, $image->id);
        }

        $listImage = implode(',', $listImage);

        return $listImage;
    }
}


if ( !function_exists( 'getProductLogo' ) ) {
    function getProductLogo($productId)
    {
        $media = new MediaService();
        $logo = $media->getLogoByProductId($productId);

        return $logo;
    }
}

if (!function_exists('getStoreAddress')) {
    function getStoreAddress($storeId)
    {
        $addresses = new AddressService();
        $address = $addresses->getAddressByStoreID($storeId);

        return $address;
    }
}

if (!function_exists('listStoreHtml')) {
    function listStoreHtml($stores)
    {
        $html = '';
        if (!empty($stores)) {
            foreach ($stores as $store) {
                $html .= '<div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="'.getStoreLogoPath($store->id).'" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="store-name">'.$store->name.'</h4>
                                    <span class="store-phone store-text">
                                        <span class="label">'.trans('messages.phone').': </span>
                                        '.$store->phone.'
                                    </span>
                                    <span class="store-address store-text">
                                        <span class="label">'.trans('messages.address').': </span>
                                        '.getStoreAddress($store->id)->address.'
                                    </span>
                                    <span class="store-description store-text">
                                        <span class="label">'.trans('messages.description').': </span>
                                        '.$store->description.'
                                    </span>
                                    <div class="d-flex justify-content-between align-items-center btn-group" >
                                        <a href="/stores/'.$store->id.'" class="btn-action btn-action btn-view">'.trans('messages.view').'</a>
                                        <a href="/stores/'.$store->id.'/edit" class="btn-action btn-edit">'.trans('messages.edit').'</a>
                                        <form action="/stores/'.$store->id.'" method="POST" class="form-delete">
                                            <input type="hidden" name="_method" value="delete">
                                            '.
                                            csrf_field().'
                                            <button type="submit" class="btn-action btn-delete btn-delete-store" data-id="'.$store->id.'">'.trans('messages.delete').'</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>';
            }
        }
        else {
            $html = '<h2 class="not-found">Khong tìm thấy cửa hàng</h2>';
        }

        return $html;
    }
}

if (!function_exists('getAllCategory')) {
    function getAllCategory()
    {
        $query = new CategoryService();
        $categories = $query->allCategory();

        return $categories;
    }
}

if (!function_exists('getAllCategoryByStore')) {
    function getAllCategoryByStore($storeId)
    {
        $queryProduct = new ProductService();
        $queryCategory = new CategoryService();
        $products = $queryProduct->getAllProductInStore($storeId);
        $listCategory = [];
        $categories = [];
        if (!empty($products)) {
            foreach ($products as $product) {
                array_push($listCategory, $product->category_id);
            }
            $listCategory = array_unique($listCategory);
            $categories = $queryCategory->getCategoryStore($listCategory);
        }

        return $categories;
    }
}
