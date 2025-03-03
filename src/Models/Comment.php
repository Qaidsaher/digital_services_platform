<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class Comment
{
    public $id;
    public $text;
    public $date;
    public $ticket_id;
    public $creator_id;
    public $creator_type;
    public $created_at;
    public $updated_at;

    // Static PDO instance for database communication.
    protected static $pdo;

    /**
     * Set the PDO instance for all models.
     *
     * @param PDO $pdo
     */
    public static function setPDO(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    /**
     * Comment constructor
     */
    public function __construct(array $data = [])
    {
        $this->id           = $data['id'] ?? null;
        $this->text         = $data['text'] ?? '';
        $this->date         = $data['date'] ?? date('Y-m-d H:i:s');
        $this->ticket_id    = $data['ticket_id'] ?? null;
        $this->creator_id   = $data['creator_id'] ?? null;
        $this->creator_type = $data['creator_type'] ?? 'trainee'; // Default to 'trainee'
        $this->created_at   = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at   = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    /**
     * Get all comments.
     */
    public static function all()
    {
        $conn = DB::getConnection();
        $stmt = $conn->query("SELECT * FROM comments ORDER BY date DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self($row), $results);
    }

    /**
     * Find a comment by ID.
     */
    public static function find($id)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($data) : null;
    }

    /**
     * Get comments by multiple conditions.
     */
    public static function where(array $conditions)
    {
        $conn = DB::getConnection();
        if (empty($conditions)) {
            return [];
        }

        $query = "SELECT * FROM comments WHERE ";
        $params = [];
        $conditionsArray = [];

        foreach ($conditions as $column => $value) {
            $conditionsArray[] = "$column = ?";
            $params[] = $value;
        }

        $query .= implode(" AND ", $conditionsArray);
        $query .= " ORDER BY date DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self($row), $results);
    }

    /**
     * Save or update a comment.
     */
    public function save()
    {
        $conn = DB::getConnection();

        if ($this->id) {
            $stmt = $conn->prepare(
                "UPDATE comments 
                SET text = ?, date = ?, ticket_id = ?, creator_id = ?, creator_type = ?, updated_at = NOW() 
                WHERE id = ?"
            );
            return $stmt->execute([
                $this->text, 
                $this->date, 
                $this->ticket_id, 
                $this->creator_id, 
                $this->creator_type, 
                $this->id
            ]);
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO comments 
                (text, date, ticket_id, creator_id, creator_type, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())"
            );
            $result = $stmt->execute([
                $this->text, 
                $this->date, 
                $this->ticket_id, 
                $this->creator_id, 
                $this->creator_type
            ]);
            if ($result) {
                $this->id = $conn->lastInsertId();
            }
            return $result;
        }
    }

    /**
     * Delete a comment.
     */
    public function delete()
    {
        if (!$this->id) {
            return false;
        }
        $conn = DB::getConnection();
        $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    /**
     * Fill model attributes.
     */
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
    public function getText()
    {
        return $this->text;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getTicketId()
    {
        return $this->ticket_id;
    }
    public function getCreatorId()
    {
        return $this->creator_id;
    }
    public function getCreatorType()
    {
        return $this->creator_type;
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
