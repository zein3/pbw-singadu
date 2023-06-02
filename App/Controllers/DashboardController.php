<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        AuthHelper::performAuthentication();
        $this->view('index', [
            'jumlah_laporan' => 100,
            'jumlah_pencacah' => 300,
            'jumlah_pengawas' => 100,
            'user' => AuthHelper::getAuthenticatedUser()
        ]);
    }
}