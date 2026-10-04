<?php

class AuthMiddleware {
    public static function check($pdo) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Check if basic session keys exist
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['session_token'])) {
            header('Location: /layered/public/login');
            exit;
        }

        // 2. Strict Database Verification
        $stmt = $pdo->prepare("SELECT session_token FROM student WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user doesn't exist or the session token doesn't match the database record
        if (!$user || $user['session_token'] !== $_SESSION['session_token']) {
            session_unset();
            session_destroy();
            header('Location: /layered/public/login');
            exit;
        }
    }
}

?>