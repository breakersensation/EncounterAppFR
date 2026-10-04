<?php

namespace App\Controllers;

use App\Controllers\AuthController;

class AuthenticatedController {

    protected int $userId;

    public function __construct() {

        $this->userId = AuthController::requireLogin();
    }
}