<?php
require_once __DIR__ . '/Router.php';

$router = new Router();

$router->get('/api/countries', __DIR__ . '/api/countries.php');
$router->post('/api/countries', __DIR__ . '/api/countries_create.php');

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

if (str_starts_with($requestUri, '/api/')) {
    $router->run(); 
} else {
    require __DIR__ . '/index.html';
}
