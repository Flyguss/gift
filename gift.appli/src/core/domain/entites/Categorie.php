<?php

namespace gift\appli\core\domain\entites;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table='categorie';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

    public function getPrestation(){
        return $this->hasMany('gift\appli\core\domain\entites\Prestation', 'cat_id' , 'id');
    }
}