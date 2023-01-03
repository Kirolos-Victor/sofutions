<?php

namespace App\Services;

class StoreLogoService
{
    public function execute($request): string
    {
        $file = $request->file('logo');
        $filename = time() . $file->getClientOriginalName();
        $file->storeAs('public/images', $filename);
        return $filename;
    }
}
