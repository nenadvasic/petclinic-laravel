<?php

namespace App\Models;

class Visit extends AbstractModel
{
    protected $table = 'visits';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vet()
    {
        return $this->belongsTo('\App\Models\Vet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pet()
    {
        return $this->belongsTo('\App\Models\Pet');
    }
}
