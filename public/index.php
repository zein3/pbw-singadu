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
$router = new Router();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $router->add('', ['controller' => 'DashboardController', 'action' => 'index']);
    $router->add('login', ['controller' => 'AuthController', 'action' => 'showLogin']);
    $router->add('my-profile', ['controller' => 'DashboardController', 'action' => 'profile']);
    $router->add('laporan', ['controller' => 'DashboardController', 'action' => 'laporan']);
    $router->add('laporan/create', ['controller' => 'DashboardController', 'action' => 'createLaporan']);
    $router->add('user', ['controller' => 'DashboardController', 'action' => 'user']);
    $router->add('jenis-masalah', ['controller' => 'DashboardController', 'action' => 'problemType']);

    $router->add('api/v1/user', ['controller' => 'UserController', 'action' => 'index']);
    $router->add('api/v1/user/role/{role}', ['controller' => 'UserController', 'action' => 'getUsersWithRole']);
    $router->add('api/v1/user/supervised/{id:\d+}', ['controller' => 'UserController', 'action' => 'getUsersSupervisedBy']);
    $router->add('api/v1/report', ['controller' => 'ReportController', 'action' => 'index']);
    $router->add('api/v1/problem-type', ['controller' => 'ProblemTypeController', 'action' => 'index']);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
    $router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);

    $router->add('api/v1/user', ['controller' => 'UserController', 'action' => 'store']);
    $router->add('api/v1/report', ['controller' => 'ReportController', 'action' => 'store']);
    $router->add('api/v1/problem-type', ['controller' => 'ProblemTypeController', 'action' => 'store']);

} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $router->add('api/v1/user/{id:\d+}', ['controller' => 'UserController', 'action' => 'update']);
    $router->add('api/v1/user/profile', ['controller' => 'UserController', 'action' => 'updateProfile']);
    $router->add('api/v1/user/password', ['controller' => 'UserController', 'action' => 'updatePassword']);
    $router->add('api/v1/report/{id:\d+}', ['controller' => 'ReportController', 'action' => 'update']);
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $router->add('api/v1/user/{id:\d+}', ['controller' => 'UserController', 'action' => 'destroy']);
    $router->add('api/v1/report/{id:\d+}', ['controller' => 'ReportController', 'action' => 'destroy']);
    $router->add('api/v1/problem-type/{id:\d+}', ['controller' => 'ProblemTypeController', 'action' => 'destroy']);
}

$router->dispatch($_SERVER['REQUEST_URI']);