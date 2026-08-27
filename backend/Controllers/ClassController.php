<?php

namespace App\Controllers;

use App\Models\ClassDefinition;

class ClassController {
    
    public function index(){
        header('Content-Type: application/json');

        echo json_encode(ClassDefinition::orderBy('name')->get());
    }
}