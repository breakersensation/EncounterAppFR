<?php

use App\Controllers\ClassController;

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (
    $method === 'GET' 
    && preg_match(
        '#^/api/characters/(\d+)$#',
        $uri,
        $matches
    )) {
        $controller = new App\Controllers\CharacterController();

        $controller->show($matches[1]);

        exit;
    }

if($method === 'GET' &&
    preg_match('#^/api/species$#', $uri)) {
        $controller = new App\Controllers\SpeciesController();
        $controller->index();
        exit;
    }

if($method === 'GET' && preg_match('#^/api/classes$#', $uri)){
    $controller = new App\Controllers\ClassController();
    $controller->index();
    exit;
}

if($method === 'GET' && preg_match('#^/api/backgrounds$#', $uri)){
    $controller = new App\Controllers\BackgroundController();
    $controller->index();
    exit;
}

if($method === 'POST' && preg_match('#^/api/characters$#', $uri)){
    $controller = new App\Controllers\CharacterController();
    $controller->store();
}

if($method === 'GET' && preg_match('#^/api/characters/(\d+)$#', $uri, $matches)){
    $controller = new App\Controllers\CharacterController();
    $controller->show($matches[1]);
}
if($method === 'PATCH' && preg_match('#^/api/characters/(\d+)$#', $uri, $matches)){
    $controller = new App\Controllers\CharacterController();
    $controller->update($matches[1]);
    exit;
}