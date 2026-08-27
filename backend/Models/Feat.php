<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feat extends Model
{
    protected $table = 'feats';

    protected $guarded = [];

    public $timestamps = false;

    public function characters()
        {
            return $this->belongsToMany(Character::class);
        }
}