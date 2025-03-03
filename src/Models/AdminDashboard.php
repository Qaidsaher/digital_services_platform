<?php
namespace App\Models;

use PDO;

class AdminDashboard {
    protected static $pdo;

    public static function setPDO(PDO $pdo) {
        self::$pdo = $pdo;
    }

    // Returns overall statistics from the five tables.
    public static function getStatistics() {
        return [
            'totalSupervisors' => (int) self::$pdo->query("SELECT COUNT(*) FROM supervisors")->fetchColumn(),
            'totalTrainees'    => (int) self::$pdo->query("SELECT COUNT(*) FROM trainees")->fetchColumn(),
            'totalTickets'     => (int) self::$pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn(),
            'totalContents'    => (int) self::$pdo->query("SELECT COUNT(*) FROM contents")->fetchColumn(),
            'totalComments'    => (int) self::$pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn(),
        ];
    }

    // Returns the most recent supervisors (limit default 5)
    public static function getNewSupervisors($limit = 5) {
        $stmt = self::$pdo->prepare("SELECT * FROM supervisors ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Returns the most recent trainees (limit default 5)
    public static function getNewTrainees($limit = 5) {
        $stmt = self::$pdo->prepare("SELECT * FROM trainees ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Returns ticket counts grouped by status for a chart
    public static function getTicketsByStatus() {
        $stmt = self::$pdo->query("SELECT status, COUNT(*) as count FROM tickets GROUP BY status");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Returns the most recent tickets (limit default 5)
    public static function getRecentTickets($limit = 5) {
        $stmt = self::$pdo->prepare("SELECT * FROM tickets ORDER BY created_date DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Returns the most recent comments (limit default 5)
    public static function getRecentComments($limit = 5) {
        $stmt = self::$pdo->prepare("SELECT * FROM comments ORDER BY date DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
