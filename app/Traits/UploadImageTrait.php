<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UploadImageTrait
{
    public function uploadImage($image): string
    {
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('uploads', $imageName, ['disk' => 'public']);

        return $imageName;
    }

}
