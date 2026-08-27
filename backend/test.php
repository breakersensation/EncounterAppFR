<?php

require 'bootstrap.php';

use App\Models\Character;
use App\Models\Feat;
use App\Models\Condition;
use App\Models\CharacterActiveCondition;

// $character = Character::find(1);

// $character = new Character();

// $character->name = 'Chorin';
// $character->race_id = 4;
// $character->background_id = 4;

// $character->str_score = 16;
// $character->dex_score = 12;
// $character->con_score = 14;
// $character->int_score = 10;
// $character->wis_score = 13;
// $character->cha_score = 8;

// $character->max_hp = 12;
// $character->hit_die = 'd10';
// $character->movement_speed = 30;

// $character->user_id = 1;

// $character->save();

// echo $character->name . PHP_EOL;

// echo $character->race->name . PHP_EOL;

// $raceCharacters =  $character->race->characters;

// echo "Characters of the same race:" . PHP_EOL;
// foreach ($raceCharacters as $c) {
//     echo $c->name . PHP_EOL;
// }

// $findChar = Character::find(3);

// $findChar->max_hp = 20;
// $findChar->save();

//####################### Testing character feats
// // $alertFeatId = Feat::where('name', 'Alert')->first()->id;
// $toughFeatId = Feat::where('name', 'Tough')->first()->id;
// $findChar->feats()->attach($toughFeatId);

// $secondFind = Character::find(3);
// $secondFindFeats = implode(', ', $secondFind->feats->pluck('name')->toArray());

// echo $secondFind->name . " has max HP of " . $secondFind->max_hp . " and he's a " 
// . $secondFind->race->name . " with these feats: " . $secondFindFeats . PHP_EOL;

// $characters = Character::with('race')->get();

// foreach ($characters as $character) {

//     echo $character->name . " is a " . $character->race->name . PHP_EOL;
// }

// ############################# Testing character conditions
// $targetCharacter = Character::find(3);
// //give character condition of stunned for 2 rounds from a spell cast by an enemy
// $stunnedConditionId = Condition::where('name', 'Stunned')->first()->id;
// $activeCondition = new CharacterActiveCondition();
// $activeCondition->condition_id = $stunnedConditionId;
// $activeCondition->source = 'Enemy Wizard';
// $activeCondition->rounds_remaining = 2;
// $targetCharacter->activeConditions()->save($activeCondition);

// $tcConditions = $targetCharacter->activeConditions()->with('condition')->get();
// foreach ($tcConditions as $ac) {
//     echo $targetCharacter->name . " is affected by " . $ac->condition->name . " from " . $ac->source . " for " . $ac->rounds_remaining . " rounds." . PHP_EOL;
// }

echo "##############" . PHP_EOL;

$character = Character::with(
    'classes.classDefinition'
)->find(1);

foreach ($character->classes as $class)
{
    echo $class->classDefinition->name;
    echo ' ';
    echo $class->class_level;
}
echo PHP_EOL . "##############" . PHP_EOL;

$checkCharacter = Character::with([
    'classes.classDefinition',
    'background',
    'race',
    'activeConditions.condition',
])->find(1);

echo json_encode($checkCharacter->toArray(), JSON_PRETTY_PRINT);