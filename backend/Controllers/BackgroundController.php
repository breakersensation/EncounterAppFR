<?php

namespace App\Controllers;

use App\Models\Background;

class BackgroundController{

    public function index(){
        header('Content-Type: application/json');

        echo json_encode(Background::orderBy('name')->get());
    }
}