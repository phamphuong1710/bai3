<?php

use App\Service\CategoryService;

if (!function_exists('getProductTemplate')) {
    function getProductTemplate($products)
    {
        $html = '';
        if (!empty($products)) {
            foreach ($products as $product) {
                if ( app()->getLocale() == 'en' ) {
                    if ( $product->on_sale != 0 ) {
                        $price = '<span class="item_price">' .
                                    $product->usd - ( $product->on_sale / 100 * $product->usd ) .
                                        '<span class="currency">' .
                                            trans('messages.curentcy') .
                                        '</span>
                                </span>
                                <del>'.
                                    $product->usd .
                                    '<span class="currency">' .
                                        trans('messages.curentcy') .
                                    '</span>
                                </del>';
                    } else {
                        $price = '<span class="item_price">' .
                                    $product->usd .
                                    '<span class="currency">' .
                                    trans('messages.curentcy') .
                                    '</span>
                                </span>';
                    }
                }
                if ( app()->getLocale() == 'vi' ) {
                    if ( $product->on_sale != 0 ) {
                        $price = '<span class="item_price">' .
                                    $product->vnd - ( $product->on_sale / 100 * $product->vnd ) .
                                        '<span class="currency">' .
                                            trans('messages.curentcy') .
                                        '</span>
                                </span>
                                <del>'.
                                    $product->vnd .
                                    '<span class="currency">' .
                                        trans('messages.curentcy') .
                                    '</span>
                                </del>';
                    } else {
                        $price = '<span class="item_price">' .
                                    $product->vnd .
                                    '<span class="currency">' .
                                    trans('messages.curentcy') .
                                    '</span>
                                </span>';
                    }
                }
                $html .= '<div id="product-'.$product->id.'" class="product">
                            <div class="product-content">
                                <div class="image-product-wrapper">
                                    <a href="/products/' . $product->slug . '">
                                        <img src="" alt="Image Feature">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="/products/' . $product->slug . '">
                                        <h3 class="product-name">'.$product->name.'</h3>
                                    </a>
                                    <div class="info-product-price">' .
                                        $price .
                                    '</div>
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


if (!function_exists('formatNumber')) {
    function formatNumber($number, $lamTronSoSauDauPhay) {
        $number = (int)(pow(10, $lamTronSoSauDauPhay) * $number);
        $number = $number/pow(10, $lamTronSoSauDauPhay);

        return $number;
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
