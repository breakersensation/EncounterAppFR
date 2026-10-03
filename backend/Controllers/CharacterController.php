<?php

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Character;
use App\Models\CharacterState;
use App\Models\CharacterClass;
use App\Controllers\AuthController;

class CharacterController
{
    public function show(int $id){

        $userId = AuthController::requireLogin();

        $character = Character::with([
            'race',
            'background',
            'character_state',
            'feats',
            'classes.classDefinition'
        ])->find($id);

        if($character->user_id !== $userId){
            http_response_code(403);
            echo json_encode([   'error' => 'Forbidden - user: ' . $userId . ' does not own this character: ' . $character->user_id   ]);
            return;
        }

        header('Content-Type: application/json');

        echo json_encode($character, JSON_PRETTY_PRINT);
    }

    public function store(){
        //require login
        $userId = AuthController::requireLogin();

        $input = json_decode(file_get_contents('php://input'), true);

        //validation
        if(empty($input['name'])){
            http_response_code(422);
            echo json_encode(['error' => 'Name is required']);
            return;
        }

        //save
        $character = Capsule::connection()->transaction(function () use ($input, $userId) {
            $character = Character::create([
                'user_id' => $userId,
                'name' => $input['name'],
                'race_id' => $input['singularSpeciesId'],
                'background_id' => $input['backgroundId'],
                'max_hp' => 0,
                'str_score' => $input['str_score'],
                'dex_score' => $input['dex_score'],
                'con_score' => $input['con_score'],
                'int_score' => $input['int_score'],
                'wis_score' => $input['wis_score'],
                'cha_score' => $input['cha_score']
            ]);

            CharacterState::create([
                'character_id' => $character->id,
                'current_hp' => 0,
                'temp_hp' => 0,
            ]);

            CharacterClass::create([
                'character_id' => $character->id,
                'class_id' => $input['singularClassId'],
                'class_level' => 1
            ]);

            return $character;
        });

        //response
        echo json_encode(['id' => $character->id]);
    }

     public function update(int $id){
        //require login
        $userId = AuthController::requireLogin();
        
        $input = json_decode(file_get_contents('php://input'), true) ?? [];

         //validation
        if(empty($input['name'])){
            http_response_code(422);
            echo json_encode(['error' => 'Name is required']);
            return;
        }

        $character = Character::find($id);
        if(!$character){
            http_response_code(404);
            echo json_encode(['error' => 'Character not found']);
            return;
        }

        if($character->user_id !== $userId){
            http_response_code(403);
            echo json_encode([   'error' => 'Forbidden - user does not own this character'   ]);
            return;
        }

        $backgroundId = $input['backgroundId'] ?? null;
        if($backgroundId === ''){
            $backgroundId = $character->background_id;
        }

        $character->update([
            'name' => $input['name'],
            // 'race_id' => $input['singularSpeciesId'] ?? $character->race_id,
            'race_id' => $character->race_id,
            'background_id' => $backgroundId ?? $character->background_id,
            'max_hp' => $character->max_hp,
            'str_score' => $input['str_score'] ?? $character->str_score,
            'dex_score' => $input['dex_score'] ?? $character->dex_score,
            'con_score' => $input['con_score'] ?? $character->con_score,
            'int_score' => $input['int_score'] ?? $character->int_score,
            'wis_score' => $input['wis_score'] ?? $character->wis_score,
            'cha_score' => $input['cha_score'] ?? $character->cha_score,
        ]);

        if(!empty($input['singularClassId'])){
            $characterClass = CharacterClass::where('character_id', $character->id)->first();
            if($characterClass){
                $characterClass->class_id = $input['singularClassId'];
                $characterClass->save();
            }
        }

        //response
        echo json_encode(['id' => $character->id]);

     }

    public function races(){
        $races = Capsule::table('races')->get();

        header('Content-Type: application/json');

        echo json_encode($races, JSON_PRETTY_PRINT);
    }

    public function backgrounds(){
        $backgrounds = Capsule::class('backgrounds')->get();

        header('Content-Type: application/json');

        echo json_encode($backgrounds, JSON_PRETTY_PRINT);
    }

    public function classes(){
        $classes = Capsule::class('classes')->get();

        header('Content-Type: application/json');

        echo json_encode($classes, JSON_PRETTY_PRINT);
    }
}