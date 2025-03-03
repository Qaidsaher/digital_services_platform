<?php
use App\Core\Auth;

function auth() {
    return new Auth();
}
if (!function_exists('route')) {
    /**
     * Return a URL for the given route name.
     *
     * @param string $name
     * @param array  $params Optional parameters to replace in the URL.
     * @return string
     */
    function route($name, $params = [])
    {
        // Base route to prepend (adjust this as needed)
        $addRoute = '/digital/public';

        // Define all routes with $addRoute prepended.
        // Public routes first...
        $routes = [
            'home'                  => $addRoute . '/',
            'login'                 => $addRoute . '/login',
            'register'              => $addRoute . '/register',
            'logout'                => $addRoute . '/logout',
            'account'               => $addRoute . '/account',
            'account.update'        => $addRoute . '/account/update',
            'account.delete'        => $addRoute . '/account/delete',
            'account.password.update'=> $addRoute . '/account/password/update',
            
            'about'                 => $addRoute . '/about',
            'help'                  => $addRoute . '/help',
            'contact'               => $addRoute . '/contact',
            'terms'                 => $addRoute . '/terms',
            'privacy'               => $addRoute . '/privacy',

            'supervisors'           => $addRoute . '/supervisors',
            'trainees'              => $addRoute . '/trainees',
            'tickets'               => $addRoute . '/tickets',

            'contents.add'          => $addRoute . '/contents/add',
            'comments.add'          => $addRoute . '/comments/add',
            'comments.reply'        => $addRoute . '/comments/reply',
            'dashboard.supervisor'  => $addRoute . '/supervisor/dashboard',
            // Supervisor routes for Tickets
            'supervisor.tickets.index'  => $addRoute . '/supervisor/tickets',
            'supervisor.tickets.create' => $addRoute . '/supervisor/tickets/create',
            'supervisor.tickets.show'   => $addRoute . '/supervisor/tickets/{id}',
            'supervisor.tickets.edit'   => $addRoute . '/supervisor/tickets/{id}/edit',
            'supervisor.tickets.update' => $addRoute . '/supervisor/tickets/{id}/update',
            'supervisor.tickets.delete' => $addRoute . '/supervisor/tickets/{id}/delete',

            // Supervisor routes for Contents
            'supervisor.contents.index'  => $addRoute . '/supervisor/contents',
            'supervisor.contents.create' => $addRoute . '/supervisor/contents/create',
            'supervisor.contents.show'   => $addRoute . '/supervisor/contents/{id}',
            'supervisor.contents.edit'   => $addRoute . '/supervisor/contents/{id}/edit',
            'supervisor.contents.update' => $addRoute . '/supervisor/contents/{id}/update',
            'supervisor.contents.delete' => $addRoute . '/supervisor/contents/{id}/delete',
            'supervisor.comments.store' => $addRoute . '/supervisor/comments/store',


            'dashboard.trainee'     => $addRoute . '/trainee/dashboard',
            'trainee.tickets.index'  => $addRoute . '/trainee/tickets',
            'trainee.tickets.create' => $addRoute . '/trainee/tickets/create',
            'trainee.tickets.show'   => $addRoute . '/trainee/tickets/{id}',
            'trainee.tickets.edit'   => $addRoute . '/trainee/tickets/{id}/edit',
            'trainee.tickets.update' => $addRoute . '/trainee/tickets/{id}/update',
            'trainee.tickets.delete' => $addRoute . '/trainee/tickets/{id}/delete',

            'trainee.comments.store' => $addRoute . '/trainee/comments/store',

            'trainee.contents.index'  => $addRoute . '/trainee/contents',
            'trainee.contents.show'   => $addRoute . '/trainee/contents/{id}',


            // Admin routes for dashboards, settings, etc.
            'admin.dashboard'       => $addRoute . '/admin/dashboard',
            'admin.users'           => $addRoute . '/admin/users',
            'admin.settings'        => $addRoute . '/admin/settings',
            'admin.reports'         => $addRoute . '/admin/reports',

            // Admin routes for Supervisors
            'admin.supervisors.index'  => $addRoute . '/admin/supervisors',
            'admin.supervisors.create' => $addRoute . '/admin/supervisors/create',
            'admin.supervisors.show'   => $addRoute . '/admin/supervisors/{id}',
            'admin.supervisors.edit'   => $addRoute . '/admin/supervisors/{id}/edit',
            'admin.supervisors.update' => $addRoute . '/admin/supervisors/{id}/update',

            // Admin routes for Trainees
            'admin.trainees.index'  => $addRoute . '/admin/trainees',
            'admin.trainees.create' => $addRoute . '/admin/trainees/create',
            'admin.trainees.show'   => $addRoute . '/admin/trainees/{id}',
            'admin.trainees.edit'   => $addRoute . '/admin/trainees/{id}/edit',
            'admin.trainees.update' => $addRoute . '/admin/trainees/{id}/update',

            // Admin routes for Tickets
            'admin.tickets.index'  => $addRoute . '/admin/tickets',
            'admin.tickets.create' => $addRoute . '/admin/tickets/create',
            'admin.tickets.show'   => $addRoute . '/admin/tickets/{id}',
            'admin.tickets.edit'   => $addRoute . '/admin/tickets/{id}/edit',
            'admin.tickets.update' => $addRoute . '/admin/tickets/{id}/update',
            'admin.tickets.delete' => $addRoute . '/admin/tickets/{id}/delete',

            // Admin routes for Comments
            'admin.comments.index'  => $addRoute . '/admin/comments',
            'admin.comments.create' => $addRoute . '/admin/comments/create',
            'admin.comments.show'   => $addRoute . '/admin/comments/{id}',
            'admin.comments.edit'   => $addRoute . '/admin/comments/{id}/edit',
            'admin.comments.update' => $addRoute . '/admin/comments/{id}/update',

            // Admin routes for Contents
            'admin.contents.index'  => $addRoute . '/admin/contents',
            'admin.contents.create' => $addRoute . '/admin/contents/create',
            'admin.contents.show'   => $addRoute . '/admin/contents/{id}',
            'admin.contents.edit'   => $addRoute . '/admin/contents/{id}/edit',
            'admin.contents.update' => $addRoute . '/admin/contents/{id}/update',
        ];

        $url = isset($routes[$name]) ? $routes[$name] : '';

        // Replace any route parameters (e.g., /admin/tickets/{id}) if provided.
        foreach ($params as $key => $value) {
            $url = str_replace("{" . $key . "}", $value, $url);
        }
        return $url;
    }
}
