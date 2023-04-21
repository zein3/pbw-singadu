<?php

namespace App\Helper;

use App\Models\User;
use App\Controllers\AuthController;

class AuthHelper
{
    public static function isUserAuthenticated(): bool {
        return (isset($_SESSION['USER_ID']));
    }

    public static function performAuthentication(): void {
        if (!AuthHelper::isUserAuthenticated()) {
            header("Location: /login");
            exit(0);
        }
    }

    public static function getAuthenticatedUser(): User|null {
        if (!AuthHelper::isUserAuthenticated()) {
            return null;
        }

        return User::get($_SESSION['USER_ID']);
    }
}