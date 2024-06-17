<?php

namespace gift\api\src\core\services;

use gift\api\src\core\domain\entities\Categorie;

class CategoryService
{
    public function getAllCategories(): array
    {
        return Categorie::all()->toArray();
    }

    public function getPrestationsByCategoryId(int $categoryId): array
    {
        $category = Categorie::with('prestations')->find($categoryId);
        return $category ? $category->prestations->toArray() : [];
    }
}
