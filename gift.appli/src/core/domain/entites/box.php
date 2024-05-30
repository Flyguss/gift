<?php

namespace gift\appli\core\domain\entites;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class box extends Model
{
    use HasUuids;
    protected $table='box';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

}

