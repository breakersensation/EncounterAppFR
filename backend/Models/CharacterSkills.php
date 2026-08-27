<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterSkills extends Model
{
    protected $table = 'character_skills';

    protected $guarded = [];

    public $timestamps = false;

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

}