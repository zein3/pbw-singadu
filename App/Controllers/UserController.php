<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\User;
use PDOException;

class UserController extends Controller {
    public function index() {
        AuthHelper::performAuthentication();

        $this->json(User::getAll());
    }

    public function getUsersWithRole() {
        AuthHelper::performAuthentication();
        $users = User::getAll();
        $role = $this->route_params['role'];

        $this->json(array_values(array_filter($users, fn ($user) => strtolower($user->role) === strtolower($role))));
    }

    public function getUsersSupervisedBy() {
        AuthHelper::performAuthentication();
        $supervisorId = $this->route_params['id'];

        $users = User::getAll();
        $this->json(array_values(array_filter($users, fn ($user) => $user->supervisor_id == $supervisorId)));
    }

    public function store() {
        AuthHelper::performAuthorization('admin');

        $body = file_get_contents('php://input');
        $data = json_decode($body);

        if (empty($data->name) || empty($data->email) || empty($data->password) || empty($data->role)) {
            http_response_code(400);
            $this->json(['error' => 'semua field harus diisi']);
            return;
        }

        // error_log(print_r($data, true));
        try {
            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = password_hash($data->password, PASSWORD_BCRYPT);
            $user->role = $data->role;

            $user->save();
        } catch(PDOException $ex) {
            error_log($ex->getMessage());
            http_response_code(500);
            $this->json(['error' => 'terdapat masalah saat menyimpan data']);
        }
    }

    public function update() {
        AuthHelper::performAuthorization('admin');

        $body = file_get_contents('php://input');
        $data = json_decode($body);
        $id = $this->route_params['id'];
        
        // TODO: tambahkan validasi

        try {
            $user = User::get($id);
            if ($user == null) {
                http_response_code(404);
                $this->json(['error' => 'user not found']);
                return;
            }

            $user->role = $data->role;
            $user->supervisor_id = $data->supervisor->id;
            if (strtolower($user->role) !== 'pencacah') {
                $user->supervisor_id = null;
            }

            $user->save();
        } catch(PDOException $ex) {
            http_response_code(500);
            $this->json(['error' => 'terdapat masalah saat memperbarui data']);
        }
    }

    public function destroy() {
        AuthHelper::performAuthorization('admin');

        $id = $this->route_params['id'];

        try {
            $user = User::get($id);
            $user->delete();
        } catch(PDOException $ex) {
            http_response_code(500);
            $this->json(['error' => 'terjadi kesalahan saat menghapus data']);
        }
    }
}