<?php

namespace App\Models;

class VetSpeciality extends AbstractModel
{
    protected $table = 'vet_specialities';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vets()
    {
        return $this->belongsToMany('\App\Models\Vet');
    }
}
