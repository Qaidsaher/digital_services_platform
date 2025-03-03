<?php
namespace App\Controllers\Admin;

use App\Models\Comment;

class CommentController {

    // List all comments
    public function index() {
        $comments = Comment::all();
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);
        include_once realpath(__DIR__ . '/../../../src/Views/admin/comments/index.php');
    }

    // Show a single comment
    public function show($id) {
        $comment = Comment::find($id);
        if (!$comment) {
            $_SESSION['error'] = "Comment not found.";
            header("Location: " . route('admin.comments.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/comments/show.php');
    }

    // Create a new comment
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $comment = new Comment($data);
            if ($comment->save()) {
                $_SESSION['success'] = "Comment created successfully.";
                header("Location: " . route('admin.comments.index'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to create comment.";
                header("Location: " . route('admin.comments.create'));
                exit;
            }
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/comments/create.php');
    }

    // Display the edit form for an existing comment
    public function edit($id) {
        $comment = Comment::find($id);
        if (!$comment) {
            $_SESSION['error'] = "Comment not found.";
            header("Location: " . route('admin.comments.index'));
            exit;
        }
        include_once realpath(__DIR__ . '/../../../src/Views/admin/comments/update.php');
    }

    // Process the update form submission (POST only)
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . route('admin.comments.edit', ['id' => $id]));
            exit;
        }
        $comment = Comment::find($id);
        if (!$comment) {
            $_SESSION['error'] = "Comment not found.";
            header("Location: " . route('admin.comments.index'));
            exit;
        }
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (property_exists($comment, $key)) {
                $comment->$key = $value;
            }
        }
        if ($comment->save()) {
            $_SESSION['success'] = "Comment updated successfully.";
            header("Location: " . route('admin.comments.index'));
            exit;
        } else {
            $_SESSION['error'] = "Failed to update comment.";
            header("Location: " . route('admin.comments.edit', ['id' => $id]));
            exit;
        }
    }

    // Delete a comment
    public function delete($id) {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            $_SESSION['success'] = "Comment deleted successfully.";
        } else {
            $_SESSION['error'] = "Comment not found.";
        }
        header("Location: " . route('admin.comments.index'));
        exit;
    }
}
