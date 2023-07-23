<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StoreLogoService
{
    public function execute($request): string
    {
        $file = $request->file('logo');
        $filename = time().$file->getClientOriginalName();
        $filePath = 'images/'.$filename;
        $path = Storage::disk('s3')->put($filePath, fopen($file,'r+'));
        //        $file->storeAs('public/images', $filename,'s3');
        return Storage::disk('s3')->url($filePath);
    }
}
