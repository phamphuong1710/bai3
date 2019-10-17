<?php
namespace App\Service;

use App\InterfaceService\MediaInterface;
use App\Media; // model
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use File;
use Auth;

class MediaService implements MediaInterface
{
    //Genarel
    public function createMedia($fileUpload, $userId, $storeId = null, $productId = null)
    {
        $time = Carbon::now()->timestamp;
        if($fileUpload) {
            $listImage = [];
            foreach($fileUpload as $key => $file)
            {
                $extension = $file->getClientOriginalExtension();
                $name = $time . '-' . str_random(5) . '.' . $extension;
                $smallThumbnail = config('thumbnail.small') . '-' . $name;
                $smallSize = explode('_', $smallThumbnail);
                $mediumThumbnail = config('thumbnail.medium') . '-' . $name;
                $largeThumbnail = config('thumbnail.large') . '-' . $name;
                $file->move(public_path(config('thumbnail.small_path') . date("/Y/m/d/")), $smallThumbnail);
                // $file->move(public_path(config('thumbnail.medium_path') . date("/Y/m/d/")), $mediumThumbnail);
                // $file->move(public_path(config('thumbnail.large_path') . date("/Y/m/d/")), $largeThumbnail);
                // $file->move(public_path(config('thumbnail.path') . date("/Y/m/d/")), $name);
                $link = public_path() . '/files' . date("/Y/m/d/") . $name;
                $smallLink = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $smallThumbnail;
                $this->createThumbnail($smallLink, $smallSize[0], $smallSize[1]);
                $image = new Media();
                $image->image_path = $link;
                $image->store_id = $storeId;
                $image->user_id = $userId;
                $image->save();
                array_push($listImage, $image);
            }
        }

        return $listImage;
    }

    public function updateMedia($id, $fileUpload, $userId)
    {
        $time = Carbon::now()->timestamp;
        $images = Media::findOrFail($id);
        if($fileUpload) {
            $file = $fileUpload;
            $extension = $file->getClientOriginalExtension();
            $name = $time . '-' . str_random(5) . '.' . $extension;
            $smallThumbnail = config('thumbnail.small') . '-' . $name;
            $smallSize = explode('_', $smallThumbnail);
            $mediumThumbnail = config('thumbnail.medium') . '-' . $name;
            $largeThumbnail = config('thumbnail.large') . '-' . $name;
            $file->move(public_path(config('thumbnail.small_path') . date("/Y/m/d/")), $smallThumbnail);
            $link = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $name;
            $smallLink = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $smallThumbnail;
            $this->createThumbnail($smallLink, $smallSize[0], $smallSize[1]);
            $images->image_path = $link;
            $image->user_id = $userId;
            $images->save();
        }

        return $images->image_path;
    }

    public function deleteMedia($id)
    {
        $image = Media::findOrFail($id);
        $image->product_id = null;
        $image->store_id = null;
        $image->save();

        return $image;
    }

    public function createLogo($logo, $userId, $storeId = null, $productId = null)
    {
        $time = Carbon::now()->timestamp;
        if($logo) {
            $file = $logo;
            $extension = $file->getClientOriginalExtension();
            $name = $time . '-' . str_random(5) . '.' . $extension;
            $smallThumbnail = config('thumbnail.small') . '-' . $name;
            $smallSize = explode('_', $smallThumbnail);
            $mediumThumbnail = config('thumbnail.medium') . '-' . $name;
            $largeThumbnail = config('thumbnail.large') . '-' . $name;
            $file->move(public_path(config('thumbnail.small_path') . date("/Y/m/d/")), $smallThumbnail);
            $link = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $name;
            $smallLink = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $smallThumbnail;
            $this->createThumbnail($smallLink, $smallSize[0], $smallSize[1]);
            $image = new Media();
            $image->image_path = $link;
            $image->store_id = $storeId;
            $image->product_id = $productId;
            $image->user_id = $userId;
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

    public function createVideoImage($url, $userId)
    {
        $time = Carbon::now()->timestamp;
        $info = pathinfo($url);
        $extension = pathinfo( $url, PATHINFO_EXTENSION );
        $contents = file_get_contents($url);
        $name = $time . '-' . str_random(5) . '.' . $extension;
        $smallThumbnail = config('thumbnail.small') . '-' . $name;
        $smallSize = explode('_', $smallThumbnail);
        $mediumThumbnail = config('thumbnail.medium') . '-' . $name;
        $largeThumbnail = config('thumbnail.large') . '-' . $name;
        $directory = public_path() . config('thumbnail.path') . date("/Y/m/d/");
        if ( ! File::isDirectory($directory) ) {
            File::makeDirectory($directory);
        }
        $file = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
        file_put_contents($file, $contents);
        $link = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
        $smallLink = public_path() . config('thumbnail.small_path') . date("/Y/m/d/") . $smallThumbnail;
        $this->createThumbnail($smallLink, $smallSize[0], $smallSize[1]);
        $path = config('thumbnail.path') . date("/Y/m/d/") . $name;
        $image = new Media();
        $image->image_path = $path;
        $image->user_id = $userId;
        $image->save();

        return $image;
    }

    public function getLogoByStoreId($storeId)
    {
        $logo = Media::where('store_id', $storeId)->where('active', 1)->firstOrFail();
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
        if (!empty($logos)) {
            foreach ($logos as $logo) {
                $logo->active = 0;
                $logo->save();
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
            ->firstOrFail();
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
                $logo->active = 0;
                $logo->save();
            }
        }

        return true;
    }

    public function getImageByUserId($userId)
    {
        $images = Media::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();

        return $images;
    }

    public function insertImageInLibrary($listPath, $userId)
    {
        $images = [];
        $listPath = explode(',', $listPath);
        foreach ($listPath as $path) {
            $image = new Media();
            $image->image_path = $path;
            $image->user_id = $userId;
            $image->save();
            array_push($images, $image);
        }

        return $images;
    }

    public function createImageSlider($fileUpload, $userId, $sliderId = null)
    {
        $time = Carbon::now()->timestamp;
        if($fileUpload) {
            $file = $fileUpload;
            $extension = $file->getClientOriginalExtension();
            $name = $time . '-' . str_random(5) . '.' . $extension;
            $file->move(public_path() . '/files/slider' . date("/Y/m/d/"), $name);
            $link = public_path() . '/files/slider' . date("/Y/m/d/") . $name;
            $img = Image::make($link);
            $img->fit(1920, 800);
            $img->resize(1920, 800)->save($link);
            $path = '/files/slider' . date("/Y/m/d/") . $name;
            $image = new Media();
            $image->image_path = $path;
            $image->slider_id = $sliderId;
            $image->user_id = $userId;
            $image->save();
        }

        return $image;
    }

    public function updateImageSlider($id, $sliderId)
    {
        $image = Media::findOrFail($id);
        $image->slider_id = $sliderId;
        $image->save();

        return $image;
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
