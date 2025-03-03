<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Trainee;
use App\Models\Ticket;

class TraineeController
{

    // Display trainee dashboard
    public function dashboard()
    {
        $traineeId = $_SESSION['trainee_id'];

        // Fetch the total number of comments made by the trainee
        $totalComments = count(Comment::where(['creator_id' => $traineeId]));

        // Fetch total tickets for the trainee
        $totalTickets = count(Ticket::where(['creator_id' => $traineeId]));

        // Fetch tickets based on status using multiple conditions
        $pendingTickets = count(Ticket::where(['creator_id' => $traineeId, 'status' => 'pending']));
        $openTickets = count(Ticket::where(['creator_id' => $traineeId, 'status' => 'open']));
        $closedTickets = count(Ticket::where(['creator_id' => $traineeId, 'status' => 'closed']));

        // Fetch the 5 most recent comments made by the trainee
        $recentComments = Comment::where(['creator_id' => $traineeId]);

        // Sort comments by most recent date
        usort($recentComments, fn($a, $b) => strtotime($b->date) - strtotime($a->date));

        // Get the latest 5 comments
        $recentComments = array_slice($recentComments, 0, 5);

        // Fetch the 5 most recent tickets created by the trainee
        $recentTickets = Ticket::where(['creator_id' => $traineeId]);

        // Sort tickets by most recent creation date
        usort($recentTickets, fn($a, $b) => strtotime($b->created_at) - strtotime($a->created_at));

        // Get the latest 5 tickets
        $recentTickets = array_slice($recentTickets, 0, 5);

        // Pass data to dashboard view
        include_once realpath(__DIR__ . '/../../src/Views/trainees/dashboard.php');
    }



    // List all trainee contents
    public function listTraineeContents()
    {
        $traineeId = $_SESSION['trainee_id'];

        // Fetch contents belonging to the trainee
        $contents = Content::all();

        // Pass data to the view
        include_once realpath(__DIR__ . '/../../src/Views/trainees/contents/index.php');
    }

    // Show a specific trainee content item
    public function showTraineeContentItem($id)
    {
        $content = Content::find($id);

        // Ensure the content exists and belongs to the trainee
        if (!$content ) {
            $_SESSION['error'] = "Content not found or access denied.";
            header("Location: " . route('trainee.contents.index'));
            exit;
        }

        // Pass content data to the view
        include_once realpath(__DIR__ . '/../../src/Views/trainees/contents/show.php');
    }

    // List all tickets for the trainee
    public function listTraineeTickets()
    {
        // $tickets = Ticket::where('creator_id', $_SESSION['trainee_id']);
        $tickets = Ticket::where(['creator_id' => $_SESSION['trainee_id']]);
        include_once realpath(__DIR__ . '/../../src/Views/trainees/tickets/index.php');
    }

    // Show a specific ticket
    public function showTraineeTicket($id)
    {
        $ticket = Ticket::find($id);

        // Ensure the ticket exists and belongs to the trainee
        if (!$ticket || $ticket->creator_id != $_SESSION['trainee_id']) {
            $_SESSION['error'] = "Ticket not found or access denied.";
            header("Location: " . route('trainee.tickets.index'));
            exit;
        }

        // Fetch comments related to the ticket
        $comments = Comment::where(['ticket_id' => $id]);

        // Pass ticket and comments to the view
        include_once realpath(__DIR__ . '/../../src/Views/trainees/tickets/show.php');
    }


    // Display the create ticket form
    public function createTraineeTicketForm()
    {
        include_once realpath(__DIR__ . '/../../src/Views/trainees/tickets/create.php');
    }

    // Store a new ticket
    public function storeTraineeTicket()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket = new Ticket();
                $ticket->creator_id = $_SESSION['trainee_id'];
                $ticket->title = $_POST['title'] ?? '';
                $ticket->details = $_POST['details'] ?? '';


                if ($ticket->save()) {
                    $_SESSION['success'] = "Ticket created successfully.";
                } else {
                    $_SESSION['error'] = "Failed to create ticket.";
                }
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        }

        header("Location: " . route('trainee.tickets.index'));
        exit;
    }

    // Display the edit ticket form
    public function editTraineeTicketForm($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket || $ticket->creator_id != $_SESSION['trainee_id']) {
            $_SESSION['error'] = "Ticket not found or access denied.";
            header("Location: " . route('trainee.tickets.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../src/Views/trainees/tickets/update.php');
    }

    // Update an existing ticket
    public function updateTraineeTicket($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ticket = Ticket::find($id);
                if (!$ticket || $ticket->creator_id != $_SESSION['trainee_id']) {
                    $_SESSION['error'] = "Ticket not found or access denied.";
                    header("Location: " . route('trainee.tickets.index'));
                    exit;
                }

                $ticket->title = $_POST['title'] ?? $ticket->title;
                $ticket->details = $_POST['details'] ?? $ticket->details;

                if ($ticket->save()) {
                    $_SESSION['success'] = "Ticket updated successfully.";
                } else {
                    $_SESSION['error'] = "Failed to update ticket.";
                }
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        }

        header("Location: " . route('trainee.tickets.index'));
        exit;
    }

    // Delete a ticket
    public function deleteTraineeTicket($id)
    {
        try {
            $ticket = Ticket::find($id);
            if (!$ticket || $ticket->creator_id != $_SESSION['trainee_id']) {
                $_SESSION['error'] = "Ticket not found or access denied.";
                header("Location: " . route('trainee.tickets.index'));
                exit;
            }

            if ($ticket->delete()) {
                $_SESSION['success'] = "Ticket deleted successfully.";
            } else {
                $_SESSION['error'] = "Failed to delete ticket.";
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        }

        header("Location: " . route('trainee.tickets.index'));
        exit;
    }
    public function storeTraineeComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Validate required fields
            if (empty($_POST['ticket_id']) || empty($_POST['text'])) {
                $_SESSION['error'] = "Ticket ID and Comment text are required.";
                header("Location: " . route('trainee.tickets.show', ['id' => $_POST['ticket_id']]));
                exit;
            }

            try {
                // Create new Comment instance
                $comment = new Comment([
                    'ticket_id'    => (int) $_POST['ticket_id'],
                    'creator_type' => 'trainee',
                    'creator_id'   => $_SESSION['trainee_id'],
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
        header("Location: " . route('trainee.tickets.show', ['id' => $_POST['ticket_id']]));
        exit;
    }
}
