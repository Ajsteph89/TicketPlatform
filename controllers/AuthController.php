<?php

class AuthController extends Controller
{
    public function showRegister()
    {
        $this->view('auth/register', [
            'title' => 'Register'
        ]);
    }

    public function register()
    {
        require_once __DIR__ . '/../config/db.php';

        $firstName = trim($_POST['first_name']);
        $lastName  = trim($_POST['last_name']);
        $email     = trim($_POST['email']);
        $password  = $_POST['password'];
        $confirm   = $_POST['confirm_password'];
        $role      = $_POST['role'];

        if ($password !== $confirm) {
            die('Passwords do not match.');
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (first_name, last_name, email, password, role)
            VALUES (?, ?, ?, ?, ?)
        ");

        try {
            $stmt->execute([
                $firstName,
                $lastName,
                $email,
                $hashed,
                $role
            ]);
        } catch (PDOException $e) {
            die('Registration failed: ' . $e->getMessage());
        }

        header('Location: /login');
        exit;
    }

    // SHOW LOGIN FORM
    public function showLogin()
    {
        $this->view('auth/login', [
            'title' => 'Login'
        ]);
    }

    // HANDLE LOGIN
    public function login()
    {
        require_once __DIR__ . '/../config/db.php';

        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            die('Invalid email or password.');
        }

        // STORE USER IN SESSION
        $_SESSION['user'] = [
            'id'         => $user['id'],
            'first_name' => $user['first_name'],
            'last_name'  => $user['last_name'],
            'role'       => $user['role']
        ];

        // ROLE-BASED REDIRECT
        if ($user['role'] === 'organizer') {
            header('Location: /organizer/events');
        } else {
            header('Location: /');
        }

        exit;
    }

    // LOGOUT
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
