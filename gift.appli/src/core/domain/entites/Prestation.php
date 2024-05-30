<?php

namespace gift\appli\core\domain\entites;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    protected $table='prestation';
    protected $primaryKey='id';
    public $timestamps=false;
    public $incrementing = false;
    public $keyType = 'string';

    public function setCategory(int $categoryId): void
    {
        $this->category_id = $categoryId;
        $this->save();
    }

}