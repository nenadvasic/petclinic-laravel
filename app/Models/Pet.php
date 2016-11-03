<?php

namespace App\Models;

class Pet extends AbstractModel
{
    protected $table = 'pets';

    protected $casts = [
        'vaccinated' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('\App\Models\Owner');
    }
}
