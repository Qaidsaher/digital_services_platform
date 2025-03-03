<?php
// routes/web.php

// routes/web.php

use App\Controllers\AuthController;
use App\Controllers\SupervisorController;
use App\Controllers\TraineeController;
use App\Controllers\TicketController;
use App\Controllers\ContentController;
use App\Controllers\CommentController;

use App\Controllers\Admin\SupervisorController as AdminSupervisorController;
use App\Controllers\Admin\TraineeController as AdminTraineeController;
use App\Controllers\Admin\TicketController as AdminTicketController;
use App\Controllers\Admin\ContentController as AdminContentController;
use App\Controllers\Admin\CommentController as AdminCommentController;
use App\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Controllers\AuthController as AuthCtrl;
use App\Middlewares\AuthMiddleware;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define controller paths
define('CONTROLLER_PATH', realpath(__DIR__ . '/../src/Controllers'));
define('ADMIN_CONTROLLER_PATH', realpath(__DIR__ . '/../src/Controllers/Admin'));

$request = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string if present
if (strpos($request, '?') !== false) {
    $request = strtok($request, '?');
}

// Define base path dynamically
$basePath = '/digital/public/';
if (strpos($request, $basePath) === 0) {
    $request = substr($request, strlen($basePath));
}

// Ensure $request starts with a slash; if empty, set it to '/'
$request = '/' . ltrim($request, '/');

// Function to resolve paths dynamically
function resolvePath($path)
{
    $resolvedPath = realpath(__DIR__ . '/../src/views/' . $path);
    if (!$resolvedPath || !file_exists($resolvedPath)) {
        http_response_code(404);
        echo "404 Not Found: " . $path;
        exit;
    }
    include_once $resolvedPath;
}

// Public Routes (non-admin)
$publicRoutes = [
    '/'        => 'home.php',
    '/home'    => 'home.php',
    '/about'   => 'about.php',
    '/help'    => 'help.php',
    '/contact' => 'contact.php',
    '/terms'   => 'terms.php',
    '/privacy' => 'privacy.php'
];

if (isset($publicRoutes[$request])) {
    resolvePath($publicRoutes[$request]);
} elseif ($request === '/login') {
    $auth = new AuthCtrl();
    ($httpMethod === 'GET') ? $auth->showLoginForm() : $auth->login();
} elseif ($request === '/register') {
    $auth = new AuthCtrl();
    ($httpMethod === 'GET') ? $auth->showRegisterForm() : $auth->register();
} elseif ($request === '/logout') {
    (new AuthCtrl())->logout();
} elseif ($request === '/account') {
    AuthMiddleware::check();
    (new AuthCtrl())->manageAccount();
} elseif ($request === '/account/update') {
    AuthMiddleware::check();

    (new AuthCtrl())->updateProfile();
} elseif ($request === '/account/password/update') {
    AuthMiddleware::check();
    (new AuthCtrl())->updatePassword();
} elseif ($request === '/account/delete') {
    AuthMiddleware::check();
    (new AuthCtrl())->deleteAccount();
}
// Supervisor Routes
elseif (strpos($request, '/supervisor/') === 0) {
    AuthMiddleware::supervisorOnly(); // Ensure only supervisors can access
    // Remove '/supervisor' from request
    $supervisorRequest = substr($request, strlen('/supervisor'));

    // Default Dashboard
    if ($supervisorRequest === '' || $supervisorRequest === '/' || $supervisorRequest === '/dashboard') {
        AuthMiddleware::check();
        (new SupervisorController())->dashboard();
        exit;
    }

    if ($supervisorRequest === '/comments/store') {
        AuthMiddleware::check();
        (new SupervisorController())->storeTraineeComment();
        exit;
    }
    // List all tickets
    if ($supervisorRequest === '/tickets') {
        AuthMiddleware::check();
        (new TicketController())->index();
        exit;
    }

    // Create a new ticket (display form on GET, process on POST)
    if ($supervisorRequest === '/tickets/create') {
        AuthMiddleware::check();
        // Both GET and POST are handled in the create() method of TicketController
        (new TicketController())->create();
        exit;
    }

    // Display the edit form for an existing ticket
    if (preg_match("#^/tickets/([0-9]+)/edit$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new TicketController())->edit($matches[1]);
        exit;
    }

    // Process the update form submission (POST only)
    if (preg_match("#^/tickets/([0-9]+)/update$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new TicketController())->update($matches[1]);
        exit;
    }

    // Delete a ticket
    if (preg_match("#^/tickets/([0-9]+)/delete$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new TicketController())->delete($matches[1]);
        exit;
    }

    // Show a single ticket (for example: /supervisor/tickets/123)
    if (preg_match("#^/tickets/([0-9]+)$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new TicketController())->show($matches[1]);
        exit;
    }


    // ---------------------------
    // Content Routes for Supervisor
    // ---------------------------
    // List all content items
    if ($supervisorRequest === '/contents') {
        AuthMiddleware::check();
        (new ContentController())->index();
        exit;
    }

    // Create a new content item (display form on GET, process on POST)
    if ($supervisorRequest === '/contents/create') {
        AuthMiddleware::check();
        (new ContentController())->create();
        exit;
    }

    // Display the edit form for an existing content item
    if (preg_match("#^/contents/([0-9]+)/edit$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new ContentController())->edit($matches[1]);
        exit;
    }

    // Process the update form submission (POST only) for a content item
    if (preg_match("#^/contents/([0-9]+)/update$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new ContentController())->update($matches[1]);
        exit;
    }

    // Delete a content item
    if (preg_match("#^/contents/([0-9]+)/delete$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new ContentController())->delete($matches[1]);
        exit;
    }

    // Show a single content item
    if (preg_match("#^/contents/([0-9]+)$#", $supervisorRequest, $matches)) {
        AuthMiddleware::check();
        (new ContentController())->show($matches[1]);
        exit;
    }

    // Additional supervisor-specific routes can be added here...
    http_response_code(404);
    echo "404 Not Found (Supervisor): " . $request;
}

// Trainee Routes
elseif (strpos($request, '/trainee/') === 0) {
    AuthMiddleware::traineeOnly(); // Ensure only trainees can access
    // Remove '/trainee' from request
    $traineeRequest = substr($request, strlen('/trainee'));

    // Default Dashboard
    if ($traineeRequest === '' || $traineeRequest === '/' || $traineeRequest === '/dashboard') {
        AuthMiddleware::check();
        (new TraineeController())->dashboard();
        exit;
    }

    // List all tickets (for trainees)
    if ($traineeRequest === '/tickets') {
        AuthMiddleware::check();
        (new TraineeController())->listTraineeTickets();
        exit;
    }
    if ($traineeRequest === '/contents') {
        AuthMiddleware::check();
        (new TraineeController())->listTraineeContents();
        exit;
    }
    // Show a specific ticket
    if (preg_match("#^/contents/([0-9]+)$#", $traineeRequest, $matches)) {
        AuthMiddleware::check();
        (new TraineeController())->showTraineeContentItem($matches[1]);
        exit;
    }
    // Create a new ticket (display form on GET, process on POST)
    if ($traineeRequest === '/tickets/create') {
        AuthMiddleware::check();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new TraineeController())->storeTraineeTicket();
        } else {
            (new TraineeController())->createTraineeTicketForm();
        }
        exit;
    }
    if ($traineeRequest === '/comments/store') {
        AuthMiddleware::check();
        (new TraineeController())->storeTraineeComment();
        exit;
    }

    // Show a specific ticket
    if (preg_match("#^/tickets/([0-9]+)$#", $traineeRequest, $matches)) {
        AuthMiddleware::check();
        (new TraineeController())->showTraineeTicket($matches[1]);
        exit;
    }

    // Display the edit form for an existing ticket
    if (preg_match("#^/tickets/([0-9]+)/edit$#", $traineeRequest, $matches)) {
        AuthMiddleware::check();
        (new TraineeController())->editTraineeTicketForm($matches[1]);
        exit;
    }

    // Process the update form submission (POST only)
    if (preg_match("#^/tickets/([0-9]+)/update$#", $traineeRequest, $matches)) {
        AuthMiddleware::check();
        (new TraineeController())->updateTraineeTicket($matches[1]);
        exit;
    }

    // Delete a ticket
    if (preg_match("#^/tickets/([0-9]+)/delete$#", $traineeRequest, $matches)) {
        AuthMiddleware::check();
        (new TraineeController())->deleteTraineeTicket($matches[1]);
        exit;
    }

    // 404 Not Found for undefined trainee routes
    http_response_code(404);
    echo "404 Not Found (Trainee): " . $request;
}


// Admin Routes
elseif (strpos($request, '/admin/') === 0) {
    AuthMiddleware::adminOnly(); // Ensure only admins can access
    // Remove '/admin' from request
    $adminRequest = substr($request, 6); // removes '/admin'
    if ($adminRequest === "/dashboard") {
        (new AdminDashboardController())->index();
        exit;
    }

    $adminRoutes = [
        'supervisors' => AdminSupervisorController::class,
        'trainees'    => AdminTraineeController::class,
        'tickets'     => AdminTicketController::class,
        'contents'    => AdminContentController::class,
        'comments'    => AdminCommentController::class
    ];

    foreach ($adminRoutes as $prefix => $controllerClass) {
        // Check for the create route explicitly: /admin/{prefix}/create
        if ($adminRequest === "/{$prefix}/create") {
            (new $controllerClass())->create();
            exit;
        }

        // Check for index route: /admin/{prefix}
        if ($adminRequest === "/{$prefix}") {
            (new $controllerClass())->index();
            exit;
        }

        // Check for edit route (to show the edit form): /admin/{prefix}/{id}/edit
        if (preg_match("#^/{$prefix}/([0-9]+)/edit$#", $adminRequest, $matches)) {
            (new $controllerClass())->edit($matches[1]);
            exit;
        }

        // Check for update route: /admin/{prefix}/([0-9]+)/update
        if (preg_match("#^/{$prefix}/([0-9]+)/update$#", $adminRequest, $matches)) {
            (new $controllerClass())->update($matches[1]);
            exit;
        }

        // Check for delete route: /admin/{prefix}/([0-9]+)/delete
        if (preg_match("#^/{$prefix}/([0-9]+)/delete$#", $adminRequest, $matches)) {
            (new $controllerClass())->delete($matches[1]);
            exit;
        }

        // Check for show route: /admin/{prefix}/([0-9]+)
        if (preg_match("#^/{$prefix}/([0-9]+)$#", $adminRequest, $matches)) {
            (new $controllerClass())->show($matches[1]);
            exit;
        }
    }
    http_response_code(404);
    echo "404 Not Found (Admin): " . $request;
} else {
    http_response_code(404);
    echo "404 Not Found: " . $request;
}
