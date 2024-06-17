<?php

namespace gift\api\src\core\domain\entities;


use Illuminate\Database\Eloquent\Model;

class box extends Model
{
    protected $table='box';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

    public function prestations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }
}
