<?php
// config/database.php

// Database configuration settings
$config = [
    'host'     => 'localhost',       // Database host
    'dbname'   => 'techdb',     // Database name
    'user'     => 'root',     // Database username
    'password' => '',     // Database password
    'charset'  => 'utf8mb4',           // Character set
];

try {
    // Create DSN (Data Source Name)
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

    // Set PDO options
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // Create a new PDO instance
    $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
    
    // You can now use $pdo to run your database queries.
} catch (PDOException $e) {
    // Handle connection error
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Set the PDO connection for all User models
\App\Models\User::setPDO($pdo);
\App\Models\Ticket::setPDO($pdo);
\App\Models\AdminDashboard::setPDO($pdo);