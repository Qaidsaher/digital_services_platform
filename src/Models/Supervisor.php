<?php
namespace App\Models;
use App\Database\DB;
use PDO;

class Supervisor extends User {
    protected $department;
    protected $phone;

    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->department = $data['department'] ?? '';
        $this->phone      = $data['phone'] ?? '';
    }

    // Getters
    public function getDepartment() {
        return $this->department;
    }
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Retrieve a supervisor by ID.
     *
     * @param int $id
     * @return Supervisor|null
     */
    public static function find($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM supervisors WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Retrieve a supervisor by email.
     *
     * @param string $email
     * @return Supervisor|null
     */
    public static function findByEmail($email) {
        $stmt = self::$pdo->prepare("SELECT * FROM supervisors WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new static($data) : null;
    }

    /**
     * Save the supervisor to the database.
     *
     * If $this->id exists, perform an UPDATE; otherwise, INSERT a new record.
     *
     * @return bool
     */
    public function save() {
        if ($this->id) {
            // Update existing record
            $stmt = self::$pdo->prepare(
                "UPDATE supervisors 
                 SET name = :name, email = :email, password = :password, department = :department, phone = :phone, updated_at = NOW()
                 WHERE id = :id"
            );
            return $stmt->execute([
                'name'       => $this->name,
                'email'      => $this->email,
                'password'   => $this->password,
                'department' => $this->department,
                'phone'      => $this->phone,
                'id'         => $this->id
            ]);
        } else {
            // Insert new record
            $stmt = self::$pdo->prepare(
                "INSERT INTO supervisors 
                (name, email, password, department, phone, created_at, updated_at)
                VALUES (:name, :email, :password, :department, :phone, NOW(), NOW())"
            );
            $result = $stmt->execute([
                'name'       => $this->name,
                'email'      => $this->email,
                'password'   => $this->password,
                'department' => $this->department,
                'phone'      => $this->phone
            ]);
            if ($result) {
                $this->id = self::$pdo->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Delete a supervisor by ID.
     *
     * @param int $id
     * @return bool
     */
    public static function deleteById($id) {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM supervisors WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
