<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DeleteLogoService
{
    public function execute($logoName): void
    {
        if (Storage::disk('s3')->exists($logoName)) {
            Storage::disk('s3')->delete($logoName);
        }
    }
}
