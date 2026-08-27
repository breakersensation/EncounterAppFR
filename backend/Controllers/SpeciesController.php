<?php

namespace App\Controllers;

use App\Models\Race;

class SpeciesController

{
    public function index()
    {
        header('Content-Type: application/json');

        echo json_encode(Race::orderBy('name')->get());
    }
}

