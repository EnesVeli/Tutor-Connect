<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class AuthController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            echo "<h1>Login Successful!</h1>";
            echo "<p>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</p>";
            echo "<a href='/logout'>Logout</a>";
            exit;
        }
        header('Location: /login');
        exit;
    }

    public function login()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $userRepo = new UserRepository();
            $user = $userRepo->findByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->first_name;
                $_SESSION['user_role'] = $user->role;
                header('Location: /');
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }
        require __DIR__ . '/../Views/Login.php';
    }

    public function register()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';

            $userRepo = new UserRepository();
            if ($userRepo->findByEmail($email)) {
                $error = "Email already registered.";
            } else {
                if ($userRepo->create($email, $password, $firstName, $lastName, $role)) {
                    header('Location: /login');
                    exit;
                } else {
                    $error = "Registration failed.";
                }
            }
        }
        require __DIR__ . '/../Views/Register.php';
    }

    public function logout() { session_destroy(); header('Location: /login'); exit; }
}