<?php

namespace App\Traits;

trait UploadImageTrait
{
    public function uploadImage($image, $folder, $disk = 'public'): string
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs("uploads/{$folder}", $imageName, ['disk' => $disk]);

        return "uploads/{$folder}/{$imageName}";
    }

}
