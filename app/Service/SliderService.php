<?php
namespace App\Service;

use App\InterfaceService\SliderInterface;
use App\Slider; // model
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;

class SliderService implements SliderInterface
{
    public function createSlider($request)
    {
        $slider = new Slider();
        $slider->description = $request->description;
        $slider->store_id = $request->store_id;
        $slider->user_id = $request->user_id;
        $slider->save();

        return $slider;
    }

    public function updateSlider($request, $id)
    {
        $slider = Slider::find($id);
        $slider->description = $request->description;
        $slider->store_id = $request->store_id;
        $slider->user_id = $request->user_id;
        $slider->save();

        return $slider;
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        Slider::destroy($id);

        return $slider;
    }

    public function getSlider()
    {
        $slider = Slider::orderBy('created_at', 'desc')
            ->paginate(3);

        return $slider;
    }

    public function getSliderById($id)
    {
        $slider = Slider::find($id);

        return $slider;
    }

    public function getAllSlider()
    {
        $slider = Slider::paginate(10);

        return $slider;
    }
}

