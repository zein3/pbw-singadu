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

    public function reports() {
        $sql = "SELECT * FROM reports WHERE reporter_id = ?";
        $query = Database::getPDO()->prepare($sql);
        $query->execute([$this->id]);

        $query->setFetchMode(PDO::FETCH_CLASS, Report::class);
        $reports = $query->fetchAll();

        return $reports;
    }

    public static function findByEmail(string $email): User|null {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = Database::getPDO()->prepare($sql);
        $query->execute([$email]);
        
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $query->fetch();

        return ($user) ? $user : null;
    }

    public static function findBySupervisorId($supervisor_id) {
        $sql = "SELECT * FROM users WHERE supervisor_id = ?";
        $query = Database::getPDO()->prepare($sql);
        $query->execute([$supervisor_id]);

        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $users = $query->fetchAll();

        return $users;
    }
}