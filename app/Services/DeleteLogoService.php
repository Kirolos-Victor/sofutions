<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class DeleteLogoService
{
    public function execute($oldFileName): void
    {
        if (File::exists(storage_path('app/public/images/' . $oldFileName))) {
            File::delete(storage_path('app/public/images/' . $oldFileName));
        }
    }
}
