<?php

// autoloader
spl_autoload_register(function ($class) {
    // pergi ke folder parent
    $root = dirname(__DIR__);
    // buat absolute path dari file nya
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Core\Router;
use App\Core\DotEnv;

if (!DotEnv::load("../.env")) {
    return;
}

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $router = new Router();

    $router->add('', ['controller' => 'DashboardController', 'action' => 'index']);
    $router->add('login', ['controller' => 'AuthController', 'action' => 'showLogin']);

    $router->add('api/v1/problem-type', ['controller' => 'ProblemTypeController', 'action' => 'index']);

    // $router->add('posts', ['controller' => 'HomeController', 'action' => 'show']);
    // $router->add('posts/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
    // $router->add('hello/{name}', ['controller' => 'HomeController', 'action' => 'showHello']);
    // $router->add('custom/{controller}/{action}');

    $router->dispatch($_SERVER['REQUEST_URI']);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $router = new Router();

    $router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
    $router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

    $router->add('api/v1/problem-type', ['controller' => 'ProblemTypeController', 'action' => 'store']);

    $router->dispatch($_SERVER['REQUEST_URI']);
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

} else if ($_SERVER['REQUEST_METHOD'] === 'DESTROY') {
    $router->add('api/v1/problem-type/{id:\d+}', ['controller' => 'ProblemTypeController', 'action' => 'destroy']);
}
