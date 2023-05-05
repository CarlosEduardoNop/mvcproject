<?php
define('URL', 'http://localhost:8000');

$router = new \App\Http\Router(URL);

$router->get('/', [
    function() {
        return newClass(\App\Controller\HomeController::class)->index();
    }
]);

$router->run()
    ->sendResponse();