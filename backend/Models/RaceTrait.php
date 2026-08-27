<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaceTrait extends Model
{
    protected $table = 'race_traits';

    protected $guarded = [];

    public $timestamps = false;

    public function race()
        {
            return $this->belongsTo(Race::class);
        }
}