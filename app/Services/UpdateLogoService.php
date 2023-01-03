<?php

namespace App\Services;

class UpdateLogoService
{
    public function execute($request, $oldFileName): string
    {
        (new DeleteLogoService())->execute($oldFileName);
        return (new StoreLogoService())->execute($request);
    }
}
