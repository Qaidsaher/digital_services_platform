<?php
namespace App\Controllers\Admin;

use App\Models\SupervisorAdmin;

class SupervisorController {

    // List all supervisors
    public function index() {
        $supervisors = SupervisorAdmin::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        include_once realpath(__DIR__ . '/../../../src/Views/admin/supervisors/index.php');
    }

    // Show a single supervisor
    public function show($id) {
        $supervisor = SupervisorAdmin::find($id);
        if (!$supervisor) {
            $_SESSION['error'] = "Supervisor not found.";
            header("Location: " . route('admin.supervisors.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/supervisors/show.php');
    }

    // Create a new supervisor
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $supervisor = new SupervisorAdmin($data);
            if ($supervisor->save()) {
                $_SESSION['success'] = "Supervisor created successfully.";
                header("Location: " . route('admin.supervisors.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create supervisor.";
                header("Location: " . route('admin.supervisors.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/supervisors/create.php');
    }

    // Display the edit form for an existing supervisor
    public function edit($id) {
        $supervisor = SupervisorAdmin::find($id);
        if (!$supervisor) {
            $_SESSION['error'] = "Supervisor not found.";
            header("Location: " . route('admin.supervisors.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/supervisors/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . route('admin.supervisors.edit', ['id' => $id]));
            exit;
        }
        $supervisor = SupervisorAdmin::find($id);
        if (!$supervisor) {
            $_SESSION['error'] = "Supervisor not found.";
            header("Location: " . route('admin.supervisors.index'));
            exit;
        }
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (property_exists($supervisor, $key)) {
                $supervisor->$key = $value;
            }
        }
        if ($supervisor->save()) {
            $_SESSION['success'] = "Supervisor updated successfully.";
            header("Location: " . route('admin.supervisors.index'));
            exit;
        } else {
            $_SESSION['error'] = "Failed to update supervisor.";
            header("Location: " . route('admin.supervisors.edit', ['id' => $id]));
            exit;
        }
    }

    // Delete a supervisor
    public function delete($id) {
        $supervisor = SupervisorAdmin::find($id);
        if ($supervisor) {
            $supervisor->delete();
            $_SESSION['success'] = "Supervisor deleted successfully.";
        } else {
            $_SESSION['error'] = "Supervisor not found.";
        }
        header("Location: " . route('admin.supervisors.index'));
        exit;
    }
}
