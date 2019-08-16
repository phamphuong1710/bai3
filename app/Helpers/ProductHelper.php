<?php

use App\Service\CategoryService;
use App\Service\AddressService;
use App\Service\MediaService;
use App\Service\ProductService;
use App\Service\RatingService;
use App\Service\SliderService;

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
                            <td>'.$category->created_at.'</td>
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
                        <td> ' . $user->created_at . '</td>
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

if ( !function_exists( 'getListImageProduct' ) ) {
    function getListImageProduct($productId)
    {
        $media = new MediaService();
        $images = $media->getImageByProductId($productId);
        $listImage = [];
        foreach ($images as $image) {
            array_push($listImage, $image->id);
        }

        $listImage = implode(',', $listImage);

        return $listImage;
    }
}

if ( !function_exists( 'getProducCategory' ) ) {
    function getCategoryName($categoryId)
    {
        $category = new CategoryService();
        $cat = $category->getCategoryById($categoryId);

        return $cat->name;
    }
}

if (!function_exists('getParentCategory')) {
    function getParentCategory()
    {
        $categories = new CategoryService();
        $parentCategory = $categories->getParentCategory();

        return $parentCategory;
    }
}

if (!function_exists('hasChildCategory')) {
    function hasChildCategory($parentId)
    {
        $categories = getChildCategory($parentId);
        array_shift($categories);
        $result = empty($categories) ? false : true;

        return $result;
    }
}

if (!function_exists('getMenuTeamplate')) {
    function getDropdownMenuTeamplate($parentId)
    {
        $categories = new CategoryService();
        $html = '';
        $listCategory = $categories->getChildCategory($parentId);
        foreach ($listCategory as $category) {
            $class = hasChildCategory($category->id) ? ' menu-item-has-children' : '';
            $openTag = hasChildCategory($category->id) ? '<ul class="sub-menu">' : '';
            $closeTag = hasChildCategory($category->id) ? '</ul>' : '';
            $html .= '<li class="menu-item' . $class . '">
                        <a class="link-nav nav-stylehead" href="/archive/' . $category->slug . '"  data-id="' . $category->id . '">'.
                            $category->name.
                        '</a>'.
                        $openTag.
                        getDropdownMenuTeamplate($category->id).
                        $closeTag.
                    '</li>';
        }

        return $html;
    }
}

if (!function_exists('getMenuTeamplate')) {
    function getMenuTeamplate()
    {
        $categories = new CategoryService();
        $listCategory = $categories->getParentCategory();
        $html = '<ul class="main-menu" id="primary-menu">
                    <li class="menu-item active">
                        <a href="/" class="nav-stylehead">'.
                            trans('messages.home').
                        '</a>
                    </li>';
        if (!empty($listCategory)) {

            foreach ($listCategory as $category) {
                $class = hasChildCategory($category->id) ? ' menu-item-has-children' : '';
                $openTag = hasChildCategory($category->id) ? '<ul class="sub-menu">' : '';
                $closeTag = hasChildCategory($category->id) ? '</ul>' : '';
                $html .= '<li class="item-menu' . $class . '">
                            <a href="/archive/' . $category->slug . '" class="nav-stylehead link-nav">'.
                                $category->name .
                            '</a>'.
                            $openTag.
                            getDropdownMenuTeamplate($category->id) .
                            $closeTag.
                        '</li>';
            }

        }
        $html .= '</ul>';

        return $html;
    }
}

if (!function_exists('productBestSeller')) {
    function productBestSeller()
    {
        $products = new ProductService();
        $bestSeller = $products->getProductBestSeller();

        return $bestSeller;
    }
}

if (!function_exists('productNew')) {
    function productNew()
    {
        $products = new ProductService();
        $new = $products->getNewProduct();

        return $new;
    }
}

if (!function_exists('getTopDiscountProduct')) {
    function getTopDiscountProduct()
    {
        $products = new ProductService();
        $listProduct = $products->getOnSaleProduct();

        return $listProduct;
    }
}


if (!function_exists('sameProductInCategory')) {
    function sameProductInCategory($id)
    {
        $query = new ProductService();
        $product = $query->getProductId($id);
        $categoryId = $product->category->id;
        $sameProduct = $query->getTheSameProductInCategory($categoryId, $id);

        return $sameProduct;
    }
}

if (!function_exists('sameProductInStore')) {
    function sameProductInStore($id)
    {
        $query = new ProductService();
        $product = $query->getProductId($id);
        $storeId = $product->store->id;
        $sameProduct = $query->getTheSameProductInStore($storeId, $id);

        return $sameProduct;
    }
}

if (!function_exists('archiveProductInCategory')) {
    function archiveProductInCategory($id)
    {
        $query = new ProductService();
        $product = $query->getProductId($id);
        $storeId = $product->store->id;
        $sameProduct = $query->getTheSameProductInStore($storeId, $id);

        return $sameProduct;
    }
}

if (!function_exists('ratingProduct')) {
    function ratingProduct($productId)
    {
        $query = new RatingService();
        $rating = $query->getRatingProductByUser($productId);
        if (!$rating) {
            $rating = false;
        }

        return $rating;
    }
}

if ( !function_exists( 'getSlider' ) ) {
    function getSlider()
    {
        $sliders = new SliderService();
        $slider = $sliders->getSlider();

        return $slider;
    }
}


