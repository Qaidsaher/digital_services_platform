<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Content
{
    public $id;
    public $title;
    public $type;
    public $content;
    public $creator_supervisor_id;
    public $created_at;
    public $updated_at;

    protected static $pdo;

    public static function setPDO(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public function __construct(array $data = [])
    {
        $this->id                    = $data['id'] ?? null;
        $this->title                 = $data['title'] ?? '';
        $this->type                  = $data['type'] ?? '';
        $this->content               = $data['content'] ?? '';
        $this->creator_supervisor_id = $data['creator_supervisor_id'] ?? ($_SESSION['supervisor_id'] ?? null);
        $this->created_at            = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at            = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public static function all()
    {
        $conn = DB::getConnection();
        $stmt = $conn->query("SELECT * FROM contents ORDER BY created_at DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            error_log("No contents found in database.");
        }

        return array_map(fn($row) => new self($row), $results);
    }


    public static function find($id)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM contents WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new self($data) : null;
    }

    public static function where(array $conditions)
    {
        $conn = DB::getConnection();

        if (empty($conditions)) {
            return [];
        }

        $query = "SELECT * FROM contents WHERE ";
        $params = [];
        $conditionsArray = [];

        foreach ($conditions as $column => $value) {
            $conditionsArray[] = "$column = ?";
            $params[] = $value;
        }

        $query .= implode(" AND ", $conditionsArray);
        $query .= " ORDER BY created_at DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            error_log("No contents found for conditions: " . print_r($conditions, true));
        }

        return array_map(fn($row) => new self($row), $results);
    }

    public function save()
    {
        $conn = DB::getConnection();
        if ($this->id) {
            $stmt = $conn->prepare("UPDATE contents 
                                    SET title = ?, type = ?, content = ?, creator_supervisor_id = ?, updated_at = ? 
                                    WHERE id = ?");
            return $stmt->execute([$this->title, $this->type, $this->content, $this->creator_supervisor_id, date('Y-m-d H:i:s'), $this->id]);
        } else {
            $stmt = $conn->prepare("INSERT INTO contents 
                                    (title, type, content, creator_supervisor_id, created_at, updated_at) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$this->title, $this->type, $this->content, $this->creator_supervisor_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
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
        $stmt = $conn->prepare("DELETE FROM contents WHERE id = ?");
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
    public function getTitle()
    {
        return $this->title;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getCreatorSupervisorId()
    {
        return $this->creator_supervisor_id;
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
