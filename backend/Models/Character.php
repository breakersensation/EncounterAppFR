<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';

    protected $guarded = [];

    public $timestamps = false;

    public function race()
        {
            return $this->belongsTo(Race::class);
        }

    public function background()
        {
            return $this->belongsTo(Background::class);
        }

    public function character_state()
        {
            return $this->hasOne(CharacterState::class);
        }

    public function feats()
        {
            return $this->belongsToMany(Feat::class);
        }

    public function activeConditions()
        {
            return $this->hasMany(CharacterActiveCondition::class);
        }

    public function classes()
        {
            return $this->hasMany(CharacterClass::class);
        }
}