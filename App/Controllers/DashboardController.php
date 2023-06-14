<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        AuthHelper::performAuthentication();

        $reports = Report::getAll();
        $users = User::getAll();

        $jumlahLaporan = count($reports);
        $jumlahPencacah = array_reduce($users, function ($carry, $user) {
            return $carry + ((strtolower($user->role) === 'pencacah') ? 1 : 0);
        }, 0);
        $jumlahPengawas = array_reduce($users, function ($carry, $user) {
            return $carry + ((strtolower($user->role) === 'pengawas') ? 1 : 0);
        }, 0);
        $jumlahLaporanSelesai = array_reduce($reports, function ($carry, $report) {
            return $carry + (($report->solved != 0) ? 1 : 0);
        }, 0);

        $this->view('index', [
            'jumlah_laporan' => $jumlahLaporan,
            'jumlah_pencacah' => $jumlahPencacah,
            'jumlah_pengawas' => $jumlahPengawas,
            'jumlah_laporan_selesai' => $jumlahLaporanSelesai,
            'jumlah_laporan_belum_selesai' => ($jumlahLaporan - $jumlahLaporanSelesai),
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