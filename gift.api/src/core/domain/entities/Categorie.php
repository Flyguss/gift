<?php

namespace gift\api\src\core\domain\entities;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table='categorie';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

    public function prestations()
    {
        return $this->hasMany(Prestation::class, 'cat_id', 'id');
    }

}