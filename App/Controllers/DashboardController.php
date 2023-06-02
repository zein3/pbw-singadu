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

    public function user() {
        AuthHelper::performAuthorization("admin");
        $this->view('user/index');
    }

    public function laporan() {
        AuthHelper::performAuthentication();
        $this->view('report/index');
    }

    public function createLaporan() {
        AuthHelper::performAuthentication();
        $this->view('report/create');
    }

    public function problemType() {
        AuthHelper::performAuthorization("admin");
        $this->view('ptype/index');
    }

    public function profile() {
        AuthHelper::performAuthentication();
        $this->view('user/profile');
    }
}