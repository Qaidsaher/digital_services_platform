<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Supervisor;
use App\Models\Trainee;
use App\Models\Admin;

class AuthController
{
    // Display the login form
    public function showLoginForm()
    {
        include_once __DIR__ . '/../Views/auth/login.php';
    }

    // Process login
    public function login()
    {
        // Retrieve form data
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $userType = $_POST['user_type'] ?? 'supervisor';
        // Validate required fields
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required.";
            header("Location: " . route('login'));
            exit;
        }

        // Retrieve user by email based on type
        if ($userType === 'admin') {
            $user = Admin::findByEmail($email);
        } elseif ($userType === 'trainee') {
            $user = Trainee::findByEmail($email);
        } else {
            $user = Supervisor::findByEmail($email);
        }

        if ($user && $user->verifyPassword($password)) {
            // Login success: store serialized user object and type in session
            $_SESSION['user'] = serialize($user);
            $_SESSION['user_type'] = $userType;

            // Redirect based on user type
            if ($userType === 'admin') {
                $_SESSION['admin_id'] = $user->getId();
                header("Location: " . route('admin.dashboard'));
            } elseif ($userType === 'trainee') {
                $_SESSION['trainee_id'] = $user->getId();
                header("Location: " . route('dashboard.trainee'));
            } else {
                $_SESSION['supervisor_id'] = $user->getId();
                header("Location: " . route('dashboard.supervisor'));
            }
            exit;
        } else {
            $_SESSION['error'] = "Invalid credentials.";
            header("Location: " . route('login'));
            exit;
        }
    }

    // Display the registration form (Admins cannot register)
    public function showRegisterForm()
    {
        include_once __DIR__ . '/../Views/auth/register.php';
    }

    // Process registration (Admins cannot register)
    public function register()
    {
        // Retrieve POST data
        $name             = $_POST['name'] ?? '';
        $email            = $_POST['email'] ?? '';
        $phone            = $_POST['phone'] ?? '';
        $password         = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $userType         = $_POST['user_type'] ?? 'supervisor';

        // Basic validations
        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: " . route('register'));
            exit;
        }
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: " . route('register'));
            exit;
        }

        // Check for existing user by email
        if ($userType === 'trainee') {
            $existing = Trainee::findByEmail($email);
        } else {
            $existing = Supervisor::findByEmail($email);
        }
        if ($existing) {
            $_SESSION['error'] = "Email is already registered.";
            header("Location: " . route('register'));
            exit;
        }

        // Create user record based on type
        if ($userType === 'trainee') {
            $major = $_POST['major'] ?? '';
            $user = new Trainee([
                'name'  => $name,
                'email' => $email,
                'phone' => $phone,
                'major' => $major
            ]);
        } else {
            $department = $_POST['department'] ?? '';
            $user = new Supervisor([
                'name'       => $name,
                'email'      => $email,
                'phone'      => $phone,
                'department' => $department
            ]);
        }

        // Set password (hashed) and save record
        $user->setPassword($password);
        if ($user->save()) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['user_type'] = $userType;
            if ($userType === 'trainee') {
                $_SESSION['trainee_id'] = $user->getId();
                header("Location: " . route('dashboard.trainee'));
            } else {
                $_SESSION['supervisor_id'] = $user->getId();

                header("Location: " . route('dashboard.supervisor'));
            }
            exit;
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: " . route('register'));
            exit;
        }
    }


    // Logout functionality
    public function logout()
    {
        session_destroy();
        header("Location: " . route('login'));
        exit;
    }

    // Process profile update (Admins cannot update personal info)
    public function updateProfile()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . route('login'));
            exit;
        }

        // Retrieve user type
        $userType = $_SESSION['user_type'] ?? 'supervisor';
        if ($userType === 'admin') {
            $_SESSION['error'] = "Admins cannot update their profile.";
            header("Location: " . route('account'));
            exit;
        }

        // Retrieve current user
        $user = unserialize($_SESSION['user']);

        // Get correct user type from the database
        if ($userType === 'trainee') {
            $user = Trainee::find($user->getId());
        } else {
            $user = Supervisor::find($user->getId());
        }

        if (!$user) {
            $_SESSION['error'] = "User not found.";
            header("Location: " . route('account'));
            exit;
        }

        // Update fields from form data
        $user->name = $_POST['name'] ?? $user->getName();
        $user->email = $_POST['email'] ?? $user->getEmail();

        // Update password if provided
        if (!empty($_POST['new_password'])) {
            $user->setPassword($_POST['new_password']);
        }

        // Save the updated user
        if ($user->save()) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['success'] = "Profile updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update profile.";
        }

        header("Location: " . route('account'));
        exit;
    }

    // Display user profile (manage account)
    public function manageAccount()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . route('login'));
            exit;
        }
        // Retrieve user from session
        $user = unserialize($_SESSION['user']);
        include_once __DIR__ . '/../Views/auth/profile.php';
    }

    // Update password (Admins can update their password)
    public function updatePassword()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . route('login'));
            exit;
        }

        // Retrieve current user
        $user = unserialize($_SESSION['user']);

        // Retrieve form inputs
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validate required fields
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: " . route('account'));
            exit;
        }

        // Check if the current password is correct
        if (!$user->verifyPassword($currentPassword)) {
            $_SESSION['error'] = "Current password is incorrect.";
            header("Location: " . route('account'));
            exit;
        }

        // Ensure new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "New passwords do not match.";
            header("Location: " . route('account'));
            exit;
        }

        // Update password
        $user->setPassword($newPassword);

        if ($user->save()) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['success'] = "Password updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update password.";
        }

        header("Location: " . route('account'));
        exit;
    }

    // Delete account (Admins can delete their account)
    public function deleteAccount()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . route('login'));
            exit;
        }

        // Retrieve current user from session
        $user = unserialize($_SESSION['user']);
        $userType = $_SESSION['user_type'] ?? 'supervisor';

        try {
            // Attempt to delete the user based on their type
            if ($userType === 'trainee') {
                $deleted = Trainee::deleteById($user->getId());
            } elseif ($userType === 'supervisor') {
                $deleted = Supervisor::deleteById($user->getId());
            } elseif ($userType === 'admin') {
                $deleted = Admin::deleteById($user->getId());
            } else {
                $deleted = false;
            }

            if ($deleted) {
                // Log out the user after account deletion
                session_destroy();
                header("Location: " . route('login'));
                exit;
            } else {
                $_SESSION['error'] = "Failed to delete account.";
                header("Location: " . route('account'));
                exit;
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
            header("Location: " . route('account'));
            exit;
        }
    }
}
