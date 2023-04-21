<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        $user = new User;
        $this->view('login');
    }
}