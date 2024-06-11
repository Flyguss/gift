<?php

namespace gift\appli\core\domain\entites;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function categorie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function box(): BelongsToMany
    {
        return $this->belongsToMany(Box::class, 'box2presta', 'presta_id', 'box_id')
            ->withPivot('quantite');
    }
}