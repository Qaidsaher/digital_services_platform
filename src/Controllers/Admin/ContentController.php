<?php
namespace App\Controllers\Admin;

use App\Models\Content;
use App\Models\SupervisorAdmin;

class ContentController {

    // List all content items
    public function index() {
        $contents = Content::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        include_once realpath(__DIR__ . '/../../../src/Views/admin/contents/index.php');
    }

    // Show a single content item
    public function show($id) {
        $contentItem = Content::find($id);
        if (!$contentItem) {
            $_SESSION['error'] = "Content not found.";
            header("Location: " . route('admin.contents.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/contents/show.php');
    }

    // Create a new content item
    public function create() {
        $supervisors = SupervisorAdmin::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $contentItem = new Content($data);
            if ($contentItem->save()) {
                $_SESSION['success'] = "Content created successfully.";
                header("Location: " . route('admin.contents.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create content.";
                header("Location: " . route('admin.contents.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/contents/create.php');
    }

    // Display the edit form for an existing content item
    public function edit($id) {
        $supervisors = SupervisorAdmin::all();

        $contentItem = Content::find($id);
        if (!$contentItem) {
            $_SESSION['error'] = "Content not found.";
            header("Location: " . route('admin.contents.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/contents/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . route('admin.contents.edit', ['id' => $id]));
            exit;
        }
        $contentItem = Content::find($id);
        if (!$contentItem) {
            $_SESSION['error'] = "Content not found.";
            header("Location: " . route('admin.contents.index'));
            exit;
        }
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (property_exists($contentItem, $key)) {
                $contentItem->$key = $value;
            }
        }
        if ($contentItem->save()) {
            $_SESSION['success'] = "Content updated successfully.";
            header("Location: " . route('admin.contents.index'));
            exit;
        } else {
            $_SESSION['error'] = "Failed to update content.";
            header("Location: " . route('admin.contents.edit', ['id' => $id]));
            exit;
        }
    }

    // Delete a content item
    public function delete($id) {
        $contentItem = Content::find($id);
        if ($contentItem) {
            $contentItem->delete();
            $_SESSION['success'] = "Content deleted successfully.";
        } else {
            $_SESSION['error'] = "Content not found.";
        }
        header("Location: " . route('admin.contents.index'));
        exit;
    }
}
