<?php
namespace App\Models;

use PDO;

class User {
    public $id;
    public $name;
    public $email;
    public $password;

    // Static PDO instance for database communication
    protected static $pdo;

    /**
     * Set the PDO instance for all user models.
     *
     * @param PDO $pdo
     */
    public static function setPDO(PDO $pdo) {
        self::$pdo = $pdo;
    }

    public function __construct(array $data = []) {
        $this->id       = $data['id'] ?? null;
        $this->name     = $data['name'] ?? '';
        $this->email    = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }

    // Set and verify password
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function verifyPassword($password) {
        
        return password_verify($password, $this->password);
    }
}
