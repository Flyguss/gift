<?php

namespace gift\api\src\core\services;

use gift\api\src\core\domain\entities\box;

class BoxService
{
    public function getBoxById(string $id): ?array
    {
        $box = Box::with('prestations')->find($id);
        return $box?->toArray();
    }
}
