<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() {
        new User(); // agar root user dibuat jika tidak ada user
        if (AuthHelper::isUserAuthenticated()) {
            header("Location: /");
            return;
        }
        $this->view('login');
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::findByEmail($email);
        if ($user == null) {
            header('Location: /login?message="Wrong email or password"');
        }

        if (password_verify($password, $user->password)) {
            session_regenerate_id();
            $_SESSION['USER_ID'] = $user->getId();

            header("Location: /");
        } else {
            header('Location: /login?message="Wrong email or password"');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login?success="Successfully logged out"');
    }
}