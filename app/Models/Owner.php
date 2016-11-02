<?php

namespace App\Models;

class Owner extends AbstractModel
{
    protected $table = 'owners';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets()
    {
        return $this->hasMany('\App\Models\Pet');
    }
}
