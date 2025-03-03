<?php
namespace App\Models;
use App\Database\DB;
use PDO;

class Trainee extends User {
    protected $major;
    protected $phone;

    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->major = $data['major'] ?? '';
        $this->phone = $data['phone'] ?? '';
    }

    // Getters
    public function getMajor() {
        return $this->major;
    }
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Retrieve a trainee by ID.
     *
     * @param int $id
     * @return Trainee|null
     */
    public static function find($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM trainees WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Retrieve a trainee by email.
     *
     * @param string $email
     * @return Trainee|null
     */
    public static function findByEmail($email) {
        $stmt = self::$pdo->prepare("SELECT * FROM trainees WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Save the trainee to the database.
     *
     * If $this->id exists, perform an UPDATE; otherwise, INSERT a new record.
     *
     * @return bool
     */
    public function save() {
        if ($this->id) {
            // Update existing record
            $stmt = self::$pdo->prepare(
                "UPDATE trainees 
                 SET name = :name, email = :email, password = :password, major = :major, phone = :phone, updated_at = NOW()
                 WHERE id = :id"
            );
            return $stmt->execute([
                'name'    => $this->name,
                'email'   => $this->email,
                'password'=> $this->password,
                'major'   => $this->major,
                'phone'   => $this->phone,
                'id'      => $this->id
            ]);
        } else {
            // Insert new record
            $stmt = self::$pdo->prepare(
                "INSERT INTO trainees 
                (name, email, password, major, phone, created_at, updated_at)
                VALUES (:name, :email, :password, :major, :phone, NOW(), NOW())"
            );
            $result = $stmt->execute([
                'name'    => $this->name,
                'email'   => $this->email,
                'password'=> $this->password,
                'major'   => $this->major,
                'phone'   => $this->phone
            ]);
            if ($result) {
                $this->id = self::$pdo->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Delete a trainee by ID.
     *
     * @param int $id
     * @return bool
     */
    public static function deleteById($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM trainees WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

