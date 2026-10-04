<?php

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): void
    {
        $users = $this->userService->getUsers();

        require __DIR__ . '/../Views/users/index.php';
    }
}