<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class TraineeAdmin
{
    public $id;
    public $name;
    public $email;
    public $major;
    public $phone;
    public $password;
    public $created_at;
    public $updated_at;

    protected static $pdo;

    public static function setPDO(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public function __construct(array $data = [])
    {
        $this->id         = $data['id'] ?? null;
        $this->name       = $data['name'] ?? '';
        $this->email      = $data['email'] ?? '';
        $this->major      = $data['major'] ?? '';
        $this->phone      = $data['phone'] ?? '';
        $this->password   = $data['password'] ?? '';
        $this->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public static function all()
    {
        $conn = DB::getConnection();
        $stmt = $conn->query("SELECT * FROM trainees");
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new self($row);
        }
        return $results;
    }

    public static function find($id)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM trainees WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new self($data) : null;
    }

    public function save()
    {
        $conn = DB::getConnection();
        if ($this->id) {
            $stmt = $conn->prepare("UPDATE trainees SET name = ?, email = ?, major = ?, phone = ?, password = ?, updated_at = ? WHERE id = ?");
            return $stmt->execute([$this->name, $this->email, $this->major, $this->phone, $this->password, date('Y-m-d H:i:s'), $this->id]);
        } else {
            $stmt = $conn->prepare("INSERT INTO trainees (name, email, major, phone, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$this->name, $this->email, $this->major, $this->phone, $this->password, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
            if ($result) {
                $this->id = $conn->lastInsertId();
            }
            return $result;
        }
    }

    public function delete()
    {
        if (!$this->id) {
            return false;
        }
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM trainees WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMajor()
    {
        return $this->major;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
