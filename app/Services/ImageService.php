<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ImageService
{

    public function moveFile ($currentImageLocation, $finalImageLocation)
    {
        if ($currentImageLocation)
        {

            $full_current_file_path = storage_path('app/public') . '/' . $currentImageLocation;

            if (is_file($full_current_file_path))
            {
                $success = Storage::disk('public')->move($currentImageLocation, $finalImageLocation);

                if ($success)
                {
                    return true;
                }
            }
        }

        return false;
    }
}