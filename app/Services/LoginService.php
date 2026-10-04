<?php

class LoginService {
    private LoginRepository $loginRepository;

    public function __construct(LoginRepository $loginRepository) {
        $this->loginRepository = $loginRepository;
    }

    public function handleLogin(string $username, string $password) {
        $user = $this->loginRepository->findByUsername($username);
        

        // 1. Check if user exists
        if (!$user) {
            throw new \Exception("Invalid credentials");
        }

        // 2. Check User-Based Database Lockout
        if (!empty($user['lockout_until']) && strtotime($user['lockout_until']) > time()) {
            $remainingSeconds = strtotime($user['lockout_until']) - time();
            $hoursLeft = ceil($remainingSeconds / 3600);
            throw new \Exception("Account is temporarily locked because of multiple attempts. Try again in {$hoursLeft} hours.");
        }

        // 3. Verify Password (ensure database column matches, e.g., 'password' or 'Password')
        $passwordField = $user['password'] ?? $user['Password'] ?? '';
        if (!password_verify($password, $passwordField)) {
            $newFailedAttempts = ($user['failed_attempts'] ?? 0) + 1;
            $lockoutUntil = null;

            // Lock for 24 hours if attempts reach 5
            if ($newFailedAttempts >= 5) {
                $lockoutUntil = date('Y-m-d H:i:s', strtotime('+24 hours'));
            }

            $this->loginRepository->updateLockoutStatus($user['id'], $newFailedAttempts, $lockoutUntil);
            
            throw new \Exception("Invalid credentials");
        }

        // 4. Success: Reset failed attempts, generate token, save to database, and return user
        $sessionToken = bin2hex(random_bytes(32)); 
        
        $this->loginRepository->updateLockoutStatus($user['id'], 0, null);
        $this->loginRepository->updateSessionToken($user['id'], $sessionToken); // <-- Saves to DB

        $user['session_token'] = $sessionToken;
        return $user;
    }
}