<?php
namespace App\Service;

use App\InterfaceService\MediaInterface;
use App\Media; // model
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;

class MediaService implements MediaInterface
{
    //Genarel
    public function createMedia($request, $storeId = null, $productId = null)
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
                $img->resize(480, 360)->save($link);
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

    public function updateMedia($id, $request)
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
            $img->resize(480, 360)->save($link);
            $path = '/files'.date("/Y/m/d/").$name;
            $images->image_path = $path;
            $images->save();
        }

        return $images->image_path;
    }

    public function deleteMedia($id)
    {
        $image = Media::findOrFail($id);
        $path = public_path().$image->image_path;
        Media::destroy($id);
        unlink($path);

        return true;
    }

    public function createLogo($request, $storeId = null, $productId = null)
    {
        if($request->hasfile('logo')) {
            $file = $request->file('logo');
            $name = Carbon::now()->timestamp.$file->getClientOriginalName();
            $extension = pathinfo( $name, PATHINFO_EXTENSION );
            $name = Carbon::now()->timestamp.'-'.str_random(5).'.'.$extension;
            $file->move(public_path().'/files/'.date("/Y/m/d/"), $name);
            $link = public_path().'/files'.date("/Y/m/d/").$name;
            $img = Image::make($link);
            $img->resize(300, 300)->save($link);
            $path = '/files'.date("/Y/m/d/").$name;
            $image = new Media();
            $image->image_path = $path;
            $image->store_id = $storeId;
            $image->product_id = $productId;
            $image->active = 1;
            $image->save();
        }

        return $image;
    }

    //Store
    public function getImageByStoreId($storeId)
    {
        $images = Media::where('store_id', $storeId)
            ->where('active', 0)
            ->orderBy('position','asc')
            ->get();

        return $images;
    }

    public function updateStoreImage($id, $storeId, $position)
    {
        $image = Media::findOrFail($id);
        $image->store_id = $storeId;
        $image->position = $position;
        $image->save();

        return $image;
    }

    public function createVideoImage($request)
    {
        $url = $request->image_path;
        $info = pathinfo($url);
        $extension = pathinfo( $url, PATHINFO_EXTENSION );
        $contents = file_get_contents($url);
        $name = Carbon::now()->timestamp.'-'.str_random(5).'.'.$extension;
        $directory = public_path().'/files'.date("/Y/m/d/");
        if ( ! File::isDirectory($directory) ) {
            File::makeDirectory($directory);
        }
        $file = public_path().'/files'.date("/Y/m/d/").$name;
        file_put_contents($file, $contents);
        $img = Image::make($file);
        $img->resize(480, 360)->save($file);
        $path = '/files'.date("/Y/m/d/").$name;
        $image = new Media();
        $image->image_path = $path;
        $image->video_path = $request->video_path;
        $image->save();

        return $image;
    }

    public function getLogoByStoreId($storeId)
    {
        $logo = Media::where('store_id', $storeId)->where('active', 1)->first();
        if (! $logo) {
            abort('404');
        }

        return $logo;
    }

    public function deleteOldStoreLogo($storeId, $id)
    {
        $logos = Media::where('store_id', $storeId)
            ->where('active', 1)
            ->whereNotIn('id', [$id])
            ->get();
        if ( ! empty($logos) ) {
            foreach ($logos as $logo) {
                $this->deleteMedia($logo->id);
            }
        }

        return true;
    }


    //Product
    public function updateProductImage($id, $productId, $position)
    {
        $image = Media::findOrFail($id);
        $image->product_id = $productId;
        $image->position = $position;
        $image->save();

        return $image;
    }

    public function getImageByProductId($productId)
    {
        $images = Media::where('product_id', $productId)
            ->where('active', 0)
            ->orderBy('position','asc')
            ->get();

        return $images;
    }

    public function getLogoByProductId($productId)
    {
        $logo = Media::where('product_id', $productId)
            ->where('active', 1)
            ->first();
        if (! $logo) {
            abort('404');
        }

        return $logo;
    }

    public function deleteOldProductLogo($productId, $id)
    {
        $logos = Media::where('product_id', $productId)
            ->where('active', 1)
            ->whereNotIn('id', [$id])
            ->get();
        if ( ! empty($logos) ) {
            foreach ($logos as $logo) {
                $this->deleteMedia($logo->id);
            }
        }

        return true;
    }
}

