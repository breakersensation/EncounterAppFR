<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterClass extends Model
{
    protected $table = 'character_classes';

    protected $guarded = [];

    public $timestamps = false;

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function classDefinition()
    {
        return $this->belongsTo(
            ClassDefinition::class,
            'class_id'
        );
    }
}