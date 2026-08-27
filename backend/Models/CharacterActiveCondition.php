<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $condition_id
 * @property int $character_id
 * @property string $source
 * @property int $rounds_remaining
 * @property \Illuminate\Support\Carbon $created_at
 */

class CharacterActiveCondition extends Model
{
        protected $table = 'character_active_conditions';

        protected $guarded = ['id'];

        public $timestamps = false;

        public function character()
        {
            return $this->belongsTo(Character::class);
        }

        public function condition()
        {
            return $this->belongsTo(Condition::class);
        }
}