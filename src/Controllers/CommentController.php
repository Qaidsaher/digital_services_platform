<?php
namespace App\Controllers;

use App\Models\Comment;

class CommentController {

    // Process adding a new comment to a ticket
    public function add() {
        $text       = $_POST['text'] ?? '';
        $ticket_id  = $_POST['ticket_id'] ?? '';
        $trainee_id = $_POST['trainee_id'] ?? '';
        // Insert comment into database logic goes here
        echo "Comment added successfully.";
    }

    // Process replying to an existing comment/inquiry
    public function reply() {
        $commentId = $_POST['comment_id'] ?? '';
        $reply     = $_POST['reply'] ?? '';
        // Insert reply logic goes here
        echo "Reply sent successfully for comment ID: " . $commentId;
    }
}
