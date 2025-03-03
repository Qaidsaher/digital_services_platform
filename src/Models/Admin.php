<?php
namespace App\Models;
use App\Database\DB;
use PDO;

class Admin extends User {
    public function __construct(array $data = []) {
        parent::__construct($data);
    }

    /**
     * Retrieve an admin by ID.
     *
     * @param int $id
     * @return Admin|null
     */
    public static function find($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM admins WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Retrieve an admin by email.
     *
     * @param string $email
     * @return Admin|null
     */
    public static function findByEmail($email) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Save the admin to the database.
     *
     * If $this->id exists, perform an UPDATE; otherwise, INSERT a new record.
     *
     * @return bool
     */
    public function save() {
        $conn = DB::getConnection();
        if ($this->id) {
            // Update existing record
            $stmt = $conn->prepare(
                "UPDATE admins 
                 SET name = :name, email = :email, password = :password, updated_at = NOW()
                 WHERE id = :id"
            );
            return $stmt->execute([
                'name'    => $this->name,
                'email'   => $this->email,
                'password'=> $this->password,
                'id'      => $this->id
            ]);
        } else {
            // Insert new record
            $stmt = $conn->prepare(
                "INSERT INTO admins 
                (name, email, password, created_at, updated_at)
                VALUES (:name, :email, :password, NOW(), NOW())"
            );
            $result = $stmt->execute([
                'name'    => $this->name,
                'email'   => $this->email,
                'password'=> $this->password
            ]);
            if ($result) {
                $this->id = $conn->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Delete an admin by ID.
     *
     * @param int $id
     * @return bool
     */
    public static function deleteById($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
