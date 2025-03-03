<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Ticket
{
    public $id;
    public $title;
    public $details;
    public $status;
    public $created_date;
    public $creator_id;
    public $assigned_supervisor_id;
    public $created_at;
    public $updated_at;

    protected static $pdo;

    public function __construct(array $data = [])
    {
        $this->id                     = $data['id'] ?? null;
        $this->title                  = $data['title'] ?? '';
        $this->details                = $data['details'] ?? '';
        $this->status                  = $data['status'] ?? 'Pending';
        $this->created_date           = $data['created_date'] ?? date('Y-m-d H:i:s');
        $this->creator_id             = $data['creator_id'] ?? null;
        $this->assigned_supervisor_id = $data['assigned_supervisor_id'] ?? null;
        $this->created_at             = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at             = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public static function setPDO(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function all()
    {
        $stmt = self::$pdo->query("SELECT * FROM tickets ORDER BY created_date DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new self($row), $results);
    }

    public static function find($id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new self($data) : null;
    }

    public static function where($conditions)
    {
        if (!is_array($conditions)) {
            $conditions = [$conditions];
        }

        $whereClauses = [];
        $values = [];

        foreach ($conditions as $column => $value) {
            $whereClauses[] = "$column = ?";
            $values[] = $value;
        }

        $whereSQL = implode(" AND ", $whereClauses);

        $stmt = self::$pdo->prepare("SELECT * FROM tickets WHERE $whereSQL ORDER BY created_date DESC");
        $stmt->execute($values);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new self($row), $results);
    }

    public function save()
    {
        if ($this->id) {
            $stmt = self::$pdo->prepare(
                "UPDATE tickets 
                 SET title = ?, details = ?, status = ?, assigned_supervisor_id = ?, updated_at = ? 
                 WHERE id = ?"
            );
            return $stmt->execute([
                $this->title,
                $this->details,
                $this->status,
                $this->assigned_supervisor_id,
                date('Y-m-d H:i:s'),
                $this->id
            ]);
        } else {
            $stmt = self::$pdo->prepare(
                "INSERT INTO tickets 
                 (title, details, status, created_date, creator_id, assigned_supervisor_id, created_at, updated_at) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $result = $stmt->execute([
                $this->title,
                $this->details,
                $this->status,
                $this->created_date,
                $this->creator_id,
                $this->assigned_supervisor_id,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s')
            ]);
            if ($result) {
                $this->id = self::$pdo->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Update Ticket Status & Assigned Supervisor
     */
    public function updateStatusAndSupervisor($status, $supervisorId)
    {
        $stmt = self::$pdo->prepare(
            "UPDATE tickets 
             SET status = ?, assigned_supervisor_id = ?, updated_at = ? 
             WHERE id = ?"
        );
        return $stmt->execute([$status, $supervisorId, date('Y-m-d H:i:s'), $this->id]);
    }

    public function delete()
    {
        if (!$this->id) {
            return false;
        }
        $stmt = self::$pdo->prepare("DELETE FROM tickets WHERE id = ?");
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
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDetails() { return $this->details; }
    public function getStatus() { return $this->status; }
    public function getCreatedDate() { return $this->created_date; }
    public function getTraineeId() { return $this->creator_id; }
    public function getSupervisorId() { return $this->assigned_supervisor_id; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
}
