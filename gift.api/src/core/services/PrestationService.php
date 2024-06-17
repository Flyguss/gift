<?php

namespace gift\api\src\core\services;

use gift\api\src\core\domain\entities\Prestation;

class PrestationService
{
    public function getAllPrestations(): array
    {
        return Prestation::all()->toArray();
    }
}
