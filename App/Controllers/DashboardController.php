<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        AuthHelper::performAuthentication();
        $this->view('home');
    }
}