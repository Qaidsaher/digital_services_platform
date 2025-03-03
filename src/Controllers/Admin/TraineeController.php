<?php
namespace App\Controllers\Admin;

use App\Models\TraineeAdmin;

class TraineeController {

    // List all trainees
    public function index() {
        $trainees = TraineeAdmin::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        include_once realpath(__DIR__ . '/../../../src/Views/admin/trainees/index.php');
    }

    // Show a single trainee
    public function show($id) {
        $trainee = TraineeAdmin::find($id);
        if (!$trainee) {
            $_SESSION['error'] = "Trainee not found.";
            header("Location: " . route('admin.trainees.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/trainees/show.php');
    }

    // Create a new trainee
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $trainee = new TraineeAdmin($data);
            if ($trainee->save()) {
                $_SESSION['success'] = "Trainee created successfully.";
                header("Location: " . route('admin.trainees.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create trainee.";
                header("Location: " . route('admin.trainees.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/trainees/create.php');
    }

    // Display the edit form for an existing trainee
    public function edit($id) {
        $trainee = TraineeAdmin::find($id);
        if (!$trainee) {
            $_SESSION['error'] = "Trainee not found.";
            header("Location: " . route('admin.trainees.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/trainees/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . route('admin.trainees.edit', ['id' => $id]));
            exit;
        }
        $trainee = TraineeAdmin::find($id);
        if (!$trainee) {
            $_SESSION['error'] = "Trainee not found.";
            header("Location: " . route('admin.trainees.index'));
            exit;
        }
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (property_exists($trainee, $key)) {
                $trainee->$key = $value;
            }
        }
        if ($trainee->save()) {
            $_SESSION['success'] = "Trainee updated successfully.";
            header("Location: " . route('admin.trainees.index'));
            exit;
        } else {
            $_SESSION['error'] = "Failed to update trainee.";
            header("Location: " . route('admin.trainees.edit', ['id' => $id]));
            exit;
        }
    }

    // Delete a trainee
    public function delete($id) {
        $trainee = TraineeAdmin::find($id);
        if ($trainee) {
            $trainee->delete();
            $_SESSION['success'] = "Trainee deleted successfully.";
        } else {
            $_SESSION['error'] = "Trainee not found.";
        }
        header("Location: " . route('admin.trainees.index'));
        exit;
    }
}
