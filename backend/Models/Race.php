<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';

    protected $guarded = [];

    public $timestamps = false;

    public function characters()
        {
            return $this->hasMany(Character::class);
        }
}