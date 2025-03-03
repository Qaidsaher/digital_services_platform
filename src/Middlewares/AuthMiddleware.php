<?php
// src/Middlewares/AuthMiddleware.php

namespace App\Middlewares;

class AuthMiddleware
{
    public static function check()
    {
        // Ensure the session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is authenticated
        if (!isset($_SESSION['user'])) {
            // Redirect to login page if not authenticated
            header("Location: " . route('login'));
            exit();
        }
    }
    /**
     * Allow only supervisors.
     */
    public static function supervisorOnly()
    {
        self::check();
        if ($_SESSION['user_type'] !== 'supervisor') {
            $_SESSION['error'] = "Access denied. Supervisors only.";
            header("Location: " . route('home'));
            exit;
        }
    }

    /**
     * Allow only trainees.
     */
    public static function traineeOnly()
    {
        self::check();
        if ($_SESSION['user_type'] !== 'trainee') {
            $_SESSION['error'] = "Access denied. Trainees only.";
            header("Location: " . route('home'));
            exit;
        }
    }

    /**
     * Allow only admins.
     */
    public static function adminOnly()
    {
        self::check();
        if ($_SESSION['user_type'] !== 'admin') {
            $_SESSION['error'] = "Access denied. Admins only.";
            header("Location: " . route('home'));
            exit;
        }
    }
}
