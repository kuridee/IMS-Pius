<?php

class LoginController {
    private LoginService $loginService;

    public function __construct(LoginService $loginService) {
        $this->loginService = $loginService;
    }

    public function authenticate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // --- 1. IP-Based Rate Limiting ---
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $timeWindow = 60; // 60 seconds window
        $maxIpAttempts = 5; // Max 5 attempts per IP

        if (!isset($_SESSION['ip_rate_limit'][$ipAddress])) {
            $_SESSION['ip_rate_limit'][$ipAddress] = [
                'count' => 0,
                'start_time' => time()
            ];
        }

        $rateData = &$_SESSION['ip_rate_limit'][$ipAddress];

        if (time() - $rateData['start_time'] > $timeWindow) {
            $rateData['count'] = 0;
            $rateData['start_time'] = time();
        }

        if ($rateData['count'] >= $maxIpAttempts) {
            $retryAfter = $timeWindow - (time() - $rateData['start_time']);
            $errorMessage = "Too many requests from your IP. Please try again in {$retryAfter} seconds.";
            require __DIR__ . '/../Views/users/login.php';
            return;
        }

        $rateData['count']++;

        // --- 2. Process Login Request ---
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $user = $this->loginService->handleLogin($username, $password);

         // 1. Regenerate session ID safely first to prevent fixation
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_regenerate_id(false);
            }
            
            // Set session and redirect on success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            $_SESSION['session_token'] = $user['session_token'];
            
            header('Location: /layered/public/dashboard');
            exit;

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            require __DIR__ . '/../Views/users/login.php';
        }
    }
}