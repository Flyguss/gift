<?php

namespace gift\appli\core\services ;

interface CatalogueServiceInterface {
    public function getCategories(): array;

    public function getCategorieById(string $id): array;

    public function getPrestation() : array ;

    public function getPrestationById(string $id): array;

    public function getPrestationsbyCategorie(int $categ_id): array;
}
