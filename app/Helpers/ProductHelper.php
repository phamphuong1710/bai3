<?php

use App\Service\CategoryService;


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
