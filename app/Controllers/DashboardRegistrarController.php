<?php

class DashboardRegistrarController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index(): void
    {
        if (!$this->authService->isAuthenticated()) {

            header('Location: /layered/public/login');
            exit;
        }

        require __DIR__ . '/../../resources/views/registrar/dashboard.php';
    }
}