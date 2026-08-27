<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $table = 'conditions';
    protected $guarded = [];

    public function activeConditions()
        {
            return $this->hasMany(CharacterActiveCondition::class);
        }

}