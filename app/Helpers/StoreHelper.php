<?php

use App\Media;

if ( ! function_exists( 'getStoreLogo' ) ) {
    function getStoreLogo($storeId)
    {
        $logo = Media::where('store_id', $storeId)->where('active', 1)->first();
        if (! $logo) {
            abort('404');
        }

        return $logo;
    }
}

if ( ! function_exists( 'getStoreLogoPath' ) ) {
    function getStoreLogoPath($storeId)
    {
        $logo = getStoreLogo($storeId);

        return $logo->image_path;
    }
}

if ( ! function_exists( 'getListImageStore' ) ) {
    function getListImageStore($storeId)
    {
        $images = Media::where('store_id', $storeId)
            ->where('active', 0)
            ->orderBy('position','asc')
            ->get();
        $listImage = [];
        foreach ($images as $image) {
            array_push($listImage, $image->id);
        }

        $listImage = implode(',', $listImage);

        return $listImage;
    }
}


if ( ! function_exists( 'getProductLogo' ) ) {
    function getProductLogo($productId)
    {
        $logo = Media::where('product_id', $productId)->where('active', 1)->first();
        if (! $logo) {
            abort('404');
        }

        return $logo;
    }
}
