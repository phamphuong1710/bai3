<?php

use App\Media;

if ( !function_exists( 'getStoreLogo' ) ) {
    function getStoreLogo($storeId)
    {
        $logo = Media::where('store_id', $storeId)->where('active', 1)->first();
        if (! $logo) {
            return;
        }

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


if ( !function_exists( 'getProductLogo' ) ) {
    function getProductLogo($productId)
    {
        $logo = Media::where('product_id', $productId)->where('active', 1)->first();
        if (! $logo) {
            abort('404');
        }

        return $logo;
    }
}

if (!function_exists('changeCurrency')) {
    function changeCurrency($price)
    {
        // set API Endpoint, access key, required parameters
        $endpoint = 'convert';
        $access_key = '8a113ba385e29c7124ed35fec13d790c';

        $from = 'VND';
        $to = 'USD';

        // initialize CURL:
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$price.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the (still encoded) JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $conversionResult = json_decode($json, true);

        // access the conversion result
        return $conversionResult['result'];
    }
}
