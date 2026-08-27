<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    public $timestamps = false;

    public function characters()
        {
            return $this->hasMany(Character::class);
        }
}