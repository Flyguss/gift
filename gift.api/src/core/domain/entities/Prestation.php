<?php

namespace gift\api\src\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table='prestation';
    protected $primaryKey='id';

    public $timestamps=false;

    public $incrementing = false;
    public $keyType = 'string';

    public function box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'cat_id', 'id');
    }
}
