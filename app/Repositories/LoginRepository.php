<?php

class LoginRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findByUsername(string $username) {
        $stmt = $this->pdo->prepare("SELECT * FROM student WHERE Username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLockoutStatus(int $userId, int $failedAttempts, ?string $lockoutUntil) {
        $stmt = $this->pdo->prepare("UPDATE student SET failed_attempts = :attempts, lockout_until = :lockout WHERE id = :id");
        $stmt->execute([
            'attempts' => $failedAttempts,
            'lockout' => $lockoutUntil,
            'id' => $userId
        ]);
    }

    public function updateSessionToken(int $userId, ?string $token) {
        $stmt = $this->pdo->prepare("UPDATE student SET session_token = :token WHERE id = :id");
        $stmt->execute([
            'token' => $token,
            'id' => $userId
        ]);
    }


}

?>