<?php
// public/index.php

// Enable error reporting (development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple PSR-4 autoloader for the App namespace (if not using Composer)
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Include the routes helper
require_once __DIR__ . '/../routes/helpers.php';

// Load database configuration (if needed)
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../Core/Auth.php';   // Load Auth Class

// Include the routing file to handle the request
require_once __DIR__ . '/../routes/web.php';
