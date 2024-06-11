<?php

namespace gift\appli\core\services;

use gift\appli\core\domain\entites\Categorie;
use gift\appli\core\domain\entites\Prestation;
use gift\appli\core\domain\entites\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CatalogueService implements CatalogueServiceInterface {

    public function getCategories(): array
    {
        try{
            return Categorie::get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException("Categorie ");
        }
    }

    public function getCategorieById(string $id): array
    {
        try{
            return Categorie::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException();
        }
    }

    public function getPrestation(): array
    {
        try{
            return Prestation::get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    public function getPrestationById(string $id): array
    {
        try{
            return Prestation::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    public function getPrestationsbyCategorie(int $categ_id): array
    {
        try{
            return Categorie::findOrFail($categ_id)->getPrestation()->get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    public function getPrestationsWithCategories(): array
    {
        try {
            return Prestation::with('categorie')->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }

    }

    public function createCategory($data) : int {
        $categorie = Categorie::create($data);
        return $categorie->id;
    }

    public function modifPrestation($data) : void {
        try {
            $prestation = Prestation::findOrFail($data['id']);
            $prestation->update($data);
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    public function setCategoryForPrestation(int $prestationId, int $categoryId) : void {
        try {
            $prestation = Prestation::findOrFail($prestationId);
            $prestation->setCategory($categoryId);
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }


}