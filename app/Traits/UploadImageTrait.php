<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UploadImageTrait
{
    public function uploadImage($image, $mainFolder, $subfolder = null, $disk = 'public'): string
    {
        if ($subfolder) {
            $folder = "$mainFolder/$subfolder";
        } else {
            $folder = $mainFolder;
        }
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $folderPath = "uploads/$folder";
        $image->storeAs($folderPath, $imageName, ['disk' => $disk]);

        return "$folderPath/$imageName";
    }
}
