<?php

namespace App\InterfaceService;

interface SliderInterface {
    public function createSlider($request);
    public function updateSlider($request, $id);
    public function deleteSlider($id);
    public function getSlider();
}
