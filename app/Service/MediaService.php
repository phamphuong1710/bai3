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
                $file->move(public_path(config('thumbnail.path') . date("/Y/m/d/")), $name);
                $link = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
                $contents = file_get_contents($link);
                $this->createThumbnail($name, $contents, config('thumbnail.small'), config('thumbnail.small_path'));
                $this->createThumbnail($name, $contents, config('thumbnail.medium'), config('thumbnail.medium_path'));
                $this->createThumbnail($name, $contents, config('thumbnail.large'), config('thumbnail.large_path'));
                $path = config('thumbnail.path') . date("/Y/m/d/") . $name;
                $image = new Media();
                $image->image_path = $path;
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
            $file->move(public_path(config('thumbnail.path') . date("/Y/m/d/")), $name);
            $link = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
            $contents = file_get_contents($link);
            $this->createThumbnail($name, $contents, config('thumbnail.small'), config('thumbnail.small_path'));
            $this->createThumbnail($name, $contents, config('thumbnail.medium'), config('thumbnail.medium_path'));
            $this->createThumbnail($name, $contents, config('thumbnail.large'), config('thumbnail.large_path'));
            $path = config('thumbnail.path') . date("/Y/m/d/") . $name;
            $image = new Media();
            $image->image_path = $path;
            $image->save();
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

    public function createLogo($logo, $userId, $storeId = null, $productId = null, $categoryId = null)
    {
        $time = Carbon::now()->timestamp;
        if($logo) {
            $file = $logo;
            $extension = $file->getClientOriginalExtension();
            $name = $time . '-' . str_random(5) . '.' . $extension;
            $file->move(public_path(config('thumbnail.path') . date("/Y/m/d/")), $name);
            $link = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
            $contents = file_get_contents($link);
            $this->createThumbnail($name, $contents, config('thumbnail.small'), config('thumbnail.small_path'));
            $this->createThumbnail($name, $contents, config('thumbnail.medium'), config('thumbnail.medium_path'));
            $this->createThumbnail($name, $contents, config('thumbnail.large'), config('thumbnail.large_path'));
            $path = config('thumbnail.path') . date("/Y/m/d/") . $name;
            $image = new Media();
            $image->image_path = $path;
            $image->store_id = $storeId;
            $image->product_id = $productId;
            $image->category_id = $categoryId;
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
        $directory = public_path() . config('thumbnail.path') . date("/Y/m/d/");
        if ( ! File::isDirectory($directory) ) {
            File::makeDirectory($directory);
        }
        $file = public_path() . config('thumbnail.path') . date("/Y/m/d/") . $name;
        file_put_contents($file, $contents);
        $this->createThumbnail($name, $contents, config('thumbnail.small'), config('thumbnail.small_path'));
        $this->createThumbnail($name, $contents, config('thumbnail.medium'), config('thumbnail.medium_path'));
        $this->createThumbnail($name, $contents, config('thumbnail.large'), config('thumbnail.large_path'));
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

    // Category
    public function updateCategoryLogo($id, $categoryId)
    {
        $image = Media::findOrFail($id);
        $image->category_id = $categoryId;
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

    public function deleteOldCategoryLogo($categoryId, $id)
    {
        $logos = Media::where('category_id', $categoryId)
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
        $listPath = [];
        foreach ($images as $image) {
            $listPath[$image->id] = $image->image_path;
        }
        $listPath = array_unique($listPath);

        return $listPath;
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

    public function createThumbnail($name, $contents, $size, $path)
    {
        $mediumThumbnail = $size . '-' . $name;
        $mediumSize = explode('_', $size);
        $mediumDirectory = public_path() . $path . date("/Y/m/d/");
        if ( ! File::isDirectory($mediumDirectory) ) {
            File::makeDirectory($mediumDirectory,0777,true);
        }
        $mediumLink = $mediumDirectory . $mediumThumbnail;
        file_put_contents($mediumLink, $contents);
        $img = Image::make($mediumLink)->resize($mediumSize[0], $mediumSize[1], function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($mediumLink);
    }
}
