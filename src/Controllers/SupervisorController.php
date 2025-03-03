<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Supervisor;
use App\Models\Ticket;

class SupervisorController {

    // Display supervisor dashboard
    public function dashboard()
    {
        $supervisorId = $_SESSION['supervisor_id'];

        // Fetch total tickets assigned to this supervisor
        $totalTickets = count(Ticket::where(['assigned_supervisor_id' => $supervisorId]));

        // Fetch tickets based on status
        $pendingTickets = count(Ticket::where(['assigned_supervisor_id' => $supervisorId, 'status' => 'pending']));
        $openTickets = count(Ticket::where(['assigned_supervisor_id' => $supervisorId, 'status' => 'open']));
        $closedTickets = count(Ticket::where(['assigned_supervisor_id' => $supervisorId, 'status' => 'closed']));

        // Fetch contents created by the supervisor
        $totalContents = count(Content::where(['creator_supervisor_id' => $supervisorId]));

        // Fetch recent tickets assigned to the supervisor (latest 5)
        $recentTickets = Ticket::where(['assigned_supervisor_id' => $supervisorId]);
        usort($recentTickets, fn($a, $b) => strtotime($b->created_at) - strtotime($a->created_at));
        $recentTickets = array_slice($recentTickets, 0, 5);

        // Fetch recent comments related to tickets assigned to the supervisor (latest 5)
        $recentComments = Comment::where(['creator_id' => $supervisorId]);
        usort($recentComments, fn($a, $b) => strtotime($b->date) - strtotime($a->date));
        $recentComments = array_slice($recentComments, 0, 5);

        include_once realpath(__DIR__ . '/../../src/Views/supervisors/dashboard.php');
    }

    // List all supervisors (for admin view)
    public function list() {
        // Retrieve list of supervisors from database
        echo "Listing all supervisors...";
    }

    // Show details for a single supervisor
    public function details($id) {
        // Retrieve supervisor by $id
        echo "Displaying details for supervisor with ID: " . $id;
    }
    public function storeTraineeComment()
    {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validate required fields
            if (empty($_POST['ticket_id']) || empty($_POST['text'])) {
                $_SESSION['error'] = "Ticket ID and Comment text are required.";
                header("Location: " . route('supervisor.tickets.show', ['id' => $_POST['ticket_id']]));
                exit;
            }

            try {
                
                // Create new Comment instance
                $comment = new Comment([
                    'ticket_id'    => (int) $_POST['ticket_id'],
                    'creator_type' => 'supervisor',
                    'creator_id'   => $_SESSION['supervisor_id'],
                    'text'         => trim($_POST['text']),
                    'date'         => date('Y-m-d H:i:s')
                ]);

                // Attempt to save the comment
                if ($comment->save()) {
                    $_SESSION['success'] = "Comment added successfully.";
                } else {
                    $_SESSION['error'] = "Failed to add comment.";
                }
            } catch (\Exception $e) {

                $_SESSION['error'] = "An error occurred: " . $e->getMessage();
            }
        } else {

            $_SESSION['error'] = "Invalid request method.";
        }

        // Redirect back to the ticket details page
        header("Location: " . route('supervisor.tickets.show', ['id' => $_POST['ticket_id']]));
        exit;
    }
}
