<?php

namespace App\Models;

class Vet extends AbstractModel
{
    protected $table = 'vets';

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
    public function vetSpecialities()
    {
        return $this->belongsToMany('\App\Models\VetSpeciality'); //, 'vet_speciality');
    }
}
