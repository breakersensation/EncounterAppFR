<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login(): void {
        //Get the raw bytes from the HTTP request body
        $rawBody = file_get_contents('php://input');

        //Convert the JSON string into a PHP associative array
        $data = json_decode($rawBody, true);

        //Pull submitted values out of the array
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = User::where('email', $email)->first();

        if(!$user){
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode([   'error' => 'Invalid email or '  ]);
            return;
        }

        if(!password_verify($password, $user->password_hash)){
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode([   'error' => 'Invalid  or password'  ]);
            return;
        }

        session_start();

        session_regenerate_id(true);

        //Remember which user is logged in
        $_SESSION['user_id'] = $user->id;

        //Authentication succeeded!!  Yay!
        //Tell the browser our response will be JSON
        header('Content-Type: application/json');

        //For now, just prove we received data
        echo json_encode([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ],
        ]);



    }
}