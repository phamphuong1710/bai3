<?php
namespace App\Service;

use App\InterfaceService\MediaInterface;
use App\Media; // model
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class MediaService implements MediaInterface
{
    //store
    public function createStoreMedia($request, $storeId = null)
    {
        if($request->hasfile('image')) {
            $listImage = [];
            foreach($request->file('image') as $key => $file)
            {
                $name = Carbon::now()->timestamp.$file->getClientOriginalName();
                $extension = pathinfo( $name, PATHINFO_EXTENSION );
                $name = Carbon::now()->timestamp.'-'.str_random(5).'.'.$extension;
                $file->move(public_path().'/files'.date("/Y/m/d/"), $name);
                $link = public_path().'/files'.date("/Y/m/d/").$name;
                $img = Image::make($link);
                $img->resize(600, 600)->save($link);
                $path = '/files'.date("/Y/m/d/").$name;
                $image = new Media();
                $image->image_path = $path;
                $image->store_id = $storeId;
                $image->save();
                array_push($listImage, $image);
            }
        }

        return $listImage;
    }

    public function updateStoreMedia($id, $request)
    {
        $images = Media::findOrFail($id);
        if($request->hasfile('image')) {
            $file = $request->image ;
            $name = Carbon::now()->timestamp.$file->getClientOriginalName();
            $extension = pathinfo( $name, PATHINFO_EXTENSION );
            $name = Carbon::now()->timestamp.'-'.str_random(5).'.'.$extension;
            $file->move(public_path().'/files'.date("/Y/m/d/"), $name);
            $link = public_path().'/files'.date("/Y/m/d/").$name;
            $img = Image::make($link);
            $img->resize(600, 600)->save($link);
            $path = '/files'.date("/Y/m/d/").$name;
            $images->image_path = $path;
            $images->save();
        }

        return $images->image_path;
    }

    public function deleteStoreMedia($id)
    {
        $image = Media::findOrFail($id);
        $path = public_path().$image->image_path;
        Media::destroy($id);
        unlink($path);
    }

    public function getImageByStoreId($storeId)
    {
        $images = Media::where('store_id', $storeId)->orderBy('position','asc')->get();

        return $images;
    }

    public function updateStoreImage($id, $storeId, $position)
    {
        $image = Media::findOrFail($id);
        $image->store_id = $storeId;
        $image->position = $position;
        $image->save();
    }

}

