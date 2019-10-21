<?php

namespace App\InterfaceService;

interface SearchInterface {
    public function searchProduct($request);

    public function searchStore($request);

    public function search($keyword);

    public function searchProductInStore($storeId, $keyword);
}
