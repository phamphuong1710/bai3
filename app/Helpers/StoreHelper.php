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
