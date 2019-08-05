<?php

use App\Service\CategoryService;
use App\Service\AddressService;

if (!function_exists('getProductHtml')) {
    function getProductHtml($products)
    {
        $html = '';
        if (!empty($products)) {
            foreach ($products as $product) {
                $html .= '<div id="product-'.$product->id.'" class="product product-admin">
                            <div class="product-content">
                                <div class="image-product-wrapper">
                                    <a href="/products/'.$product->id.'">
                                        <img src="'. getProductLogo($product->id)->image_path.'" alt="Image Feature">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="/products/'.$product->id.'">
                                        <h3 class="product-name">'.$product->name.'</h3>
                                    </a>
                                    <div class="product-price">
                                        <span class="import-price">
                                            '.trans('messages.import_price').': '.number_format($product->price,0,".",".") .'<sup>'.trans('messages.curentcy').'</sup>
                                        </span>
                                        <span class="sale-price">
                                            '.trans('messages.price_sale').': '.number_format($product->sale_price,0,".",".").'<sup>'.trans('messages.curentcy').'</sup>
                                        </span>
                                    </div>
                                </div>
                                <div class="product-action">
                                    <a href="/products/'.$product->id.'/edit" class="btn-action btn-edit">'.trans('messages.edit').'</a>
                                    <form action="/products/'.$product->id.'" method="POST" class="form-delete">
                                        <input type="hidden" name="_method" value="delete">
                                        '.csrf_field().'
                                        <button type="submit" class="btn-action btn-delete btn-delete-product" data-id="'.$product->id.'">'.trans('messages.delete').'</button>
                                    </form>
                                </div>
                            </div>
                        </div>';
            }
        }

        return $html;
    }
}

if (!function_exists('getChildCategory')) {
    function getChildCategory($categoryId, $listCategory=[])
    {
        $categories = new CategoryService();
        array_push($listCategory, $categoryId);
        $childCategory = $categories->getChildCategory($categoryId);
        if ( $childCategory ) {
            foreach ($childCategory as $category) {
                $listCategory = getChildCategory($category->id,$listCategory);
            }
        }

        return $listCategory;
    }
}

if (!function_exists('getCategoryHtml')) {
    function getCategoryHtml($categories)
    {
        $html = '';
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $html .= '<tr data-id="'.$category->id.'">
                            <td><a href="/categories/'.$category->id.'">'.$category->name.'</a></td>
                            <td>'.$category->slug.'</td>
                            <td>
                                <a href="/categories/'.$category->id.'/edit" class="btn-action btn-edit">'.trans('messages.edit') .'</a>
                                <form action="/categories/'.$category->id.'" method="POST" class="form-delete">
                                    <input type="hidden" value="delete" name="_method">
                                    '.csrf_field().'
                                    <button type="submit" class="btn-action btn-delete btn-delete-cat" data-id="{{ $category->id }}">'.trans('messages.delete').'</button>
                                </form>
                            </td>
                        </tr>';
            }
        }

        return $html;
    }
}

if (!function_exists('getUserHtml')) {
    function getUserHtml($users)
    {
        $html = '';
        foreach ($users as $user) {
            $html .= '<tr>
                        <td><a href="/users/' . $user->id . '">' . $user->name . '</a></td>
                        <td> ' . $user->phone . '</td>
                        <td> ' . $user->email . '</td>
                        <td>
                            <a href="/users/' . $user->id . '/edit" class="btn-action btn-edit">' . trans('messages.edit') .'</a>
                            <form action="/users/ '. $user->id . '" method="POST" class="form-delete">
                                <input type="hidden" name="_method" value="delete">' .
                                csrf_field() .'
                                <button type="submit" class="btn-action btn-delete"> ' . trans('messages.delete') . '</button>
                            </form>
                        </td>
                    </tr>';
        }

        return $html;
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number, $lamTronSoSauDauPhay) {
        $number = (int)(pow(10, $lamTronSoSauDauPhay) * $number);
        $number = $number/pow(10, $lamTronSoSauDauPhay);

        return $number;
    }
}
