<?php

namespace gift\appli\core\domain\entites;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class box extends Model
{
    use HasUuids;
    protected $table='box';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

    public function prestations(): BelongsToMany
    {
        return $this->belongsToMany(Prestation::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }

}

