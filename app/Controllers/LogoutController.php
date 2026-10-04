<?php

class LogoutController {
    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository) {
        $this->loginRepository = $loginRepository;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Optional: If the user is logged in, clear their session token from the database
        if (isset($_SESSION['user_id'])) {
            $this->loginRepository->updateSessionToken($_SESSION['user_id'], null);
        }

        // 1. Unset all session variables
        $_SESSION = [];

        // 2. Destroy the session cookie if it exists
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // 3. Finally, destroy the session on the server
        session_destroy();

        // 4. Redirect the user back to the login page
        header('Location: /layered/public/login');
        exit;
    }
}