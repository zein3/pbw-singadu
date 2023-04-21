<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User extends Model
{
    private static $initializing = false;

    protected $table_name = 'users';

    public $name;
    public $email;
    public $password;
    public $role;
    public $supervisor_id;

    public function __construct() {
        if (User::$initializing)
            return;

        $numOfUsers = Database::getPDO()->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ($numOfUsers == 0) {
            User::$initializing = true;
            $root = new User;

            $root->name = "root";
            $root->email = getenv("ROOT_EMAIL");
            $root->password = password_hash(getenv("ROOT_PASSWORD"), PASSWORD_BCRYPT);
            $root->role = "ADMIN";
            $root->save();
        }
    }
}