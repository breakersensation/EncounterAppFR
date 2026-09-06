<?php

namespace App\Controllers;

class AuthController
{
    public function login(): void {
        //Get the raw bytes from the HTTP request body
        $rawBody = file_get_contents('php://input');

        //Convert the JSON string into a PHP associative array
        $data = json_decode($rawBody, true);

        //Tell the browser our response will be JSON
        header('Content-Type: application/json');

        //For now, just prove we received data
        echo json_encode([
            'received' => $data
        ]);
    }
}