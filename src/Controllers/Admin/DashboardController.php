<?php
namespace App\Controllers\Admin;

use App\Models\AdminDashboard;

class DashboardController {

    public function index() {
        // Retrieve dynamic data from the model.
        $stats = AdminDashboard::getStatistics();
        $newSupervisors = AdminDashboard::getNewSupervisors();
        $newTrainees = AdminDashboard::getNewTrainees();
        $ticketsByStatus = AdminDashboard::getTicketsByStatus();
        $recentTickets = AdminDashboard::getRecentTickets();
        $recentComments = AdminDashboard::getRecentComments();

        // Set the active sidebar so the layout highlights the dashboard.
        $activeSidebar = 'dashboard';
        include_once realpath(__DIR__ . '/../../../src/Views/admin/dashboard.php');
    }
}
