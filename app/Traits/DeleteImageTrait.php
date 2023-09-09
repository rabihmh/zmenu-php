<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait DeleteImageTrait
{
    public function deleteImage($image): void
    {
        Storage::disk('public')->delete($image);
    }
}
