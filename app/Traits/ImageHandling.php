<?php

namespace App\Traits;

use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic;

trait ImageHandling
{
    public function storeImage($image, $folder, $name = null, $thumbnail = false)
    {
        if (is_file($image)) {
            $ext = $image->getClientOriginalExtension();
            $image = $image->getRealPath();
        } else {
            try {
                $ext = explode('/', mime_content_type($image))[1];
            } catch (\Exception $e) {
                $ext = 'jpg';
            }
            $base64_str = substr($image, strpos($image, ",") + 1);
            $image      = base64_decode($base64_str);
        }

        if (!file_exists(public_path('storage/' . $folder))) {
            Log::info('mau create folder');
            $a = mkdir(public_path('storage/' . $folder), 755, true);

            Log::info($a);
        }

        if ($thumbnail) {
            if (!file_exists(public_path('storage/' . $folder . '/thumbnail'))) {
                mkdir(public_path('storage/' . $folder . '/thumbnail'), 755, true);
            }
        }

        $name   = $name ?? $this->imageNameGenerator($ext);
        $store  = Image::make($image)->save(public_path('storage/' . $folder) . $name);

        if ($store) {
            if ($thumbnail) {
                $thumbnail  = Image::make($image)->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('storage/' . $folder . 'thumbnail/') . $name);
            }

            return $name;
        } else {
            return false;
        }
    }

    public function imageNameGenerator($extension = 'jpg')
    {
        return uniqid('img_') . strtotime(Carbon::now()) . '.' . $extension;
    }
}
