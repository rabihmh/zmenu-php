<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteImageTrait
{
    public function deleteImage($image): void
    {
        if ($image) {
            Storage::disk('public')->delete($image);
        }
    }
}
