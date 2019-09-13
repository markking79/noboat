<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use ImageOptimizer;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService
{

    public function moveFile ($currentImageLocation, $folderName)
    {
        if ($currentImageLocation)
        {

            $full_current_file_path = storage_path('app/public') . '/' . $currentImageLocation;

            if (is_file($full_current_file_path))
            {
                $fileName = basename($full_current_file_path);

                $finalImageLocation = 'images/' . $folderName . '/' . $fileName;

                // delete if already exists
                $full_final_file_path = storage_path('app/public') . '/' . $finalImageLocation;
                if (is_file($full_final_file_path))
                {
                    $this->deleteFile ($finalImageLocation);
                }

                $success = Storage::disk('public')->move($currentImageLocation, $finalImageLocation);

                if ($success)
                {
                    return $finalImageLocation;
                }
            }
        }

        return false;
    }

    public function copyFile ($currentImageLocation, $folderName)
    {
        $finalImageLocation = false;

        if ($currentImageLocation)
        {

            $full_current_file_path = storage_path('app/public') . '/' . $currentImageLocation;

            if (is_file($full_current_file_path))
            {
                $fileName = basename($full_current_file_path);

                $finalImageLocation = 'images/' . $folderName . '/' . $fileName;

                // delete if already exists
                $full_final_file_path = storage_path('app/public') . '/' . $finalImageLocation;
                if (is_file($full_final_file_path))
                {
                    $this->deleteFile ($finalImageLocation);
                }

                $success = Storage::disk('public')->copy($currentImageLocation, $finalImageLocation);

                if ($success)
                {
                    return $finalImageLocation;
                }
            }
        }

        return false;
    }

    public function deleteFile ($imageLocation)
    {
        if ($imageLocation)
        {

            $full_current_file_path = storage_path('app/public') . '/' . $imageLocation;

            if (is_file($full_current_file_path))
            {
                $success = Storage::disk('public')->delete($imageLocation);

                if ($success)
                {
                    return true;
                }
            }
        }

        return false;
    }

    function correctImageOrientationAndSave($file_path)
    {
        $full_current_file_path = storage_path('app/public') . '/' . $file_path;

        // split file by (.)
        $filen = explode(".", $full_current_file_path);

        // get the last part split which will be the file extension
        $ext = end($filen);
        try {

            // get the file details
            $exif = @exif_read_data($full_current_file_path);

            // check if the meta data has an Orientation value and return if not
            if (!isset($exif['Orientation']))
                return;

            $orientation = $exif['Orientation'];

            // check how to rotate (if needed)
            if (isset($orientation) && $orientation != 1){
                $deg = false;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }

                // if need to rotate
                if ($deg) {

                    // If png
                    if ($ext == "png") {
                        $img_new = imagecreatefrompng($full_current_file_path);
                        $img_new = imagerotate($img_new, $deg, 0);

                        // save rotated image
                        imagepng($img_new,$full_current_file_path);
                    }else {
                        $img_new = imagecreatefromjpeg($full_current_file_path);
                        $img_new = imagerotate($img_new, $deg, 0);

                        // save rotated image
                        imagejpeg($img_new,$full_current_file_path,80);
                    }
                }
            }

        } catch (Exception $e) {
            return;
        }

    }

    /**
     * Takes a file which is located on the server and shrinks it
     * down to a max of 1024 width and 1024 height if needed
     * then saves to original location
     *
     * @param  string
     * @return void
     */
    function shrinkImageToMax1024AndSave($file_path)
    {
        $full_current_file_path = storage_path('app/public') . '/' . $file_path;

        // load image
        $img = Image::make($full_current_file_path);

        // get image size
        $w = $img->width();
        $h = $img->height();

        // check if width or height is more than 1024
        if ($w > 1024 || $h > 1024)
        {

            if($w > $h) {

                // resize via max width
                $img->resize(1024, null, function ($constraint) {

                    $constraint->aspectRatio();

                });
            } else {

                // resize via max height
                $img->resize(null, 1024, function ($constraint) {

                    $constraint->aspectRatio();

                });
            }

            // save the image
            $img->save();

        }
    }

    public function optimizeImage ($file_path)
    {
        $full_current_file_path = storage_path('app/public') . '/' . $file_path;

        ImageOptimizer::optimize($full_current_file_path);
    }
}