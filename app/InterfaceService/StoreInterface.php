<?php

namespace App\InterfaceService;

interface StoreInterface {
    public function getAllStore();
    public function createStore($request);
}
