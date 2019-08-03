<?php

use App\Service\CategoryService;

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
