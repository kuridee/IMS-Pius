<?php

require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';

return [
    'GET' => [
        '/' => function () use ($userController) {
            $userController->index();
        },

        '/users' => function () use ($userController) {
            $userController->index();
        },

        '/student' => function () use ($studentController){
            $studentController->student();
        },

      '/register' => function () use ($studentRegistrationController){
          
            require __DIR__ . '/../app/Views/users/register.php';
        },

        '/login' => function () use ($studentRegistrationController){

              require __DIR__ .  '/../app/Views/users/login.php';
            
        },
        '/dashboard' => function () use ($studentRegistrationController, $pdo){
            AuthMiddleware::check($pdo); 
            require __DIR__ . '/../app/Views/users/dashboard.php';
        },




    ],

   'POST' => [
        '/users' => function () use ($userController) {
            $userController->store();
        },

        '/register' => function () use ($studentRegistrationController) {
            return $studentRegistrationController->Create();
        },

        // Update this line to handle authentication via your LoginController
        '/login' => function () use ($loginController) {
            $loginController->authenticate();
        },

        '/logout' =>function () use ($pdo){
            $repository = new LoginRepository($pdo);
    $controller = new LogoutController($repository);
    $controller->logout();

        },
    ],
];




