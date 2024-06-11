<?php

namespace gift\appli\core\services;

use Exception;
use gift\appli\core\domain\entites\Categorie;
use gift\appli\core\domain\entites\Prestation;
use gift\appli\core\domain\entites\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CatalogueService implements CatalogueServiceInterface {

    /**
     * @throws CategoryNotFoundException
     */
    public function getCategories(): array
    {
        try{
            return Categorie::get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException("Categorie ");
        }
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function getCategorieById(string $id): array
    {
        try{
            return Categorie::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException();
        }
    }

    /**
     * @throws PrestationNotFoundException
     */
    public function getPrestation(): array
    {
        try{
            return Prestation::get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    /**
     * @throws PrestationNotFoundException
     */
    public function getPrestationById(string $id): array
    {
        try{
            return Prestation::findOrFail($id)->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    /**
     * @throws PrestationNotFoundException
     */
    public function getPrestationsbyCategorie(int $categ_id): array
    {
        try{
            return Categorie::findOrFail($categ_id)->getPrestation()->get()->toArray();
        }catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    /**
     * @throws PrestationNotFoundException
     */
    public function getPrestationsWithCategories(): array
    {
        try {
            return Prestation::with('categorie')->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }

    }

    /**
     * @throws Exception
     */
    public function createCategory(array $data) : void {
        $libelle = $data['libelle'];
        $description = $data['description'];

        $filtered_data = [
            'libelle' => filter_var($libelle),
            'description' => filter_var($description)
        ];

        if ($filtered_data['libelle'] !== $libelle || $filtered_data['description'] !== $description) {
            throw new \Exception('Invalid data provided');
        }

        $category = new Categorie();
        $category->libelle = $filtered_data['libelle'];
        $category->description = $filtered_data['description'];


        $category->save();
    }


    /**
     * @throws PrestationNotFoundException
     */
    public function modifPrestation($data) : void {
        try {
            $prestation = Prestation::findOrFail($data['id']);
            $prestation->update($data);
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }

    /**
     * @throws PrestationNotFoundException
     */
    public function setCategoryForPrestation(int $prestationId, int $categoryId) : void {
        try {
            $prestation = Prestation::findOrFail($prestationId);
            $prestation->setCategory($categoryId);
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException();
        }
    }


}