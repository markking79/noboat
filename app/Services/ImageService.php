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
                // delete if already exists
                $full_final_file_path = storage_path('app/public') . '/' . $finalImageLocation;
                if (is_file($full_final_file_path))
                {
                    $this->deleteFile ($finalImageLocation);
                }

                $success = Storage::disk('public')->move($currentImageLocation, $finalImageLocation);

                if ($success)
                {
                    return true;
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
}