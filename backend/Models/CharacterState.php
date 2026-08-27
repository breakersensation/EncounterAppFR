<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterState extends Model
{
    protected $table = 'character_state';

    protected $guarded = [];

    public $timestamps = false;

    public function character()
        {
            return $this->belongsTo(Character::class);
        }
}