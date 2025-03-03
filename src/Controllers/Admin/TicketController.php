<?php
namespace App\Controllers\Admin;

use App\Models\Ticket;
use App\Models\TraineeAdmin;

class TicketController {

    // List all tickets
    public function index() {
        $tickets = Ticket::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        include_once realpath(__DIR__ . '/../../../src/Views/admin/tickets/index.php');
    }

    // Show a single ticket
    public function show($id) {

        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('admin.tickets.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/tickets/show.php');
    }

    // Create a new ticket
    public function create() {
        $trainees = TraineeAdmin::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $ticket = new Ticket($data);
            if ($ticket->save()) {
                $_SESSION['success'] = "Ticket created successfully.";
                header("Location: " . route('admin.tickets.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create ticket.";
                header("Location: " . route('admin.tickets.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/tickets/create.php');
    }

    // Display the edit form for an existing ticket
    public function edit($id) {
        $trainees = TraineeAdmin::all();

        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('admin.tickets.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/tickets/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id) {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            $_SESSION['error'] = "Ticket not found.";
            header("Location: " . route('admin.tickets.index'));
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            foreach ($data as $key => $value) {
                if (property_exists($ticket, $key)) {
                    $ticket->$key = $value;
                }
            }
            if ($ticket->save()) {
                $_SESSION['success'] = "Ticket updated successfully.";
                header("Location: " . route('admin.tickets.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to update ticket.";
                header("Location: " . route('admin.tickets.edit', ['id' => $id]));
                exit;
            }
        } else {
            // If not a POST request, redirect to the edit view.
            header("Location: " . route('admin.tickets.edit', ['id' => $id]));
            exit;
        }
    }

    // Delete a ticket
    public function delete($id) {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->delete();
            $_SESSION['success'] = "Ticket deleted successfully.";
        } else {
            $_SESSION['error'] = "Ticket not found.";
        }
        header("Location: " . route('admin.tickets.index'));
        exit;
    }
}
