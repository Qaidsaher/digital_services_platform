<?php

namespace App\Core;

class Auth
{
    protected static $user = null;
    protected static $userType = null;

    /**
     * Initialize authentication by retrieving the user from session.
     */
    public static function init()
    {
        if (isset($_SESSION['user'])) {
            self::$user = unserialize($_SESSION['user']);
            self::$userType = $_SESSION['user_type'] ?? null;
        }
    }

    /**
     * Check if a user is logged in (session exists).
     */
    public static function check()
    {
        Auth::init();

        return isset($_SESSION['user']);
    }

    /**
     * Get the authenticated user from session.
     */
    public static function user()
    {
        Auth::init();

        return self::$user;
    }

    /**
     * Get a specific user attribute from session.
     */
    public static function get($key)
    {
        Auth::init();

        return self::$user ? (self::$user->$key ?? null) : null;
    }

    /**
     * Get the user type (supervisor or trainee).
     */
    public static function type()
    {
        Auth::init();

        return self::$userType;
    }

    /**
     * Get the logged-in user's ID from session.
     */
    public static function id()
    {
        Auth::init();

        return self::$user ? self::$user->getId() : null;
    }

    /**
     * Check if the user is a supervisor.
     */
    public static function isSupervisor()
    {
        Auth::init();

        return self::$userType === 'supervisor';
    }

    /**
     * Check if the user is a trainee.
     */
    public static function isTrainee()
    {
        Auth::init();

        return self::$userType === 'trainee';
    }
}

// Initialize the authentication system (automatically runs at the start)
Auth::init();
