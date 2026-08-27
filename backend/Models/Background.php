<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $table = 'backgrounds';

    protected $guarded = [];

    public $timestamps = false;

    public function characters()
        {
            return $this->hasMany(Character::class);
        }
}