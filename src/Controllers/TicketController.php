<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Ticket;

class TicketController
{
    // List all tickets
    public function index()
    {
        $tickets = Ticket::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        $viewPath = realpath(__DIR__ . '/../../src/Views/supervisors/tickets/index.php');
        if ($viewPath && file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            echo "View file not found or inaccessible.";
        }

        // include_once realpath(__DIR__ . '/../../src/Views/supervisors/tickets/index.php');
    }

    // Show a single ticket
    public function show($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('supervisor.tickets.index'));
            exit;
        }
        // Fetch comments related to the ticket
        $comments = Comment::where(['ticket_id' => $id]);
        include_once realpath(__DIR__ . '/../../src/Views/supervisors/tickets/show.php');
    }

    // Create a new ticket
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $ticket = new Ticket($data);

            if ($ticket->save()) {
                $_SESSION['success'] = "Ticket created successfully.";
                header("Location: " . route('supervisor.tickets.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create ticket.";
                header("Location: " . route('supervisors.ticket.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../src/Views/supervisors/tickets/create.php');
    }

    // Display the edit form for an existing ticket
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('supervisor.tickets.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../src/Views/supervisors/tickets/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('supervisor.tickets.index'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $supervisorId = $_SESSION['supervisor_id'] ?? null;
            $status = $_POST['status'] ?? null;

            if (!$supervisorId || !$status) {
                $_SESSION['error'] = "Invalid update request. Supervisor ID or status missing.";
                header("Location: " . route('supervisor.tickets.edit', ['id' => $id]));
                exit;
            }

            if ($ticket->updateStatusAndSupervisor($status, $supervisorId)) {
                $_SESSION['success'] = "Ticket updated successfully.";
                header("Location: " . route('supervisor.tickets.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to update ticket.";
                header("Location: " . route('supervisor.tickets.edit', ['id' => $id]));
                exit;
            }
        }

        // If not a POST request, redirect to edit view
        header("Location: " . route('supervisor.tickets.edit', ['id' => $id]));
        exit;
    }

    // Delete a ticket
    public function delete($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->delete();
            $_SESSION['success'] = "Ticket deleted successfully.";
        } else {
            $_SESSION['error'] = "Ticket not found.";
        }
        header("Location: " . route('supervisor.tickets.index'));
        exit;
    }
}
