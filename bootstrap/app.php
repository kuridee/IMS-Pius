<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/Repositories/UserRepository.php';
require_once __DIR__ . '/../app/Services/UserService.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';


require_once __DIR__ . '/../app/Repositories/StudentRepository.php';
require_once __DIR__ . '/../app/Services/StudentService.php';
require_once __DIR__ . '/../app/Controllers/StudentController.php';



require_once __DIR__ . '/../app/Repositories/StudentRegistrationRepository.php';
require_once __DIR__ . '/../app/Services/StudentRegistrationService.php';
require_once __DIR__ . '/../app/Controllers/StudentRegistrationController.php';



require_once __DIR__ . '/../app/Repositories/LoginRepository.php';
require_once __DIR__ . '/../app/Services/LoginService.php';
require_once __DIR__ . '/../app/Controllers/LoginController.php';


require_once __DIR__ . '/../app/Controllers/LogoutController.php';



$userRepository = new UserRepository($pdo);
$userService = new UserService($userRepository);
$userController = new UserController($userService);


$studentRepository = new StudentRepository($pdo);
$studentService = new StudentService($studentRepository);
$studentController = new StudentController($studentService);


$studentRegistrationRepository = new StudentRegistrationRepository($pdo);
$studentRegistrationService = new StudentRegistrationService($studentRegistrationRepository);
$studentRegistrationController = new StudentRegistrationController($studentRegistrationService);


$loginRepository = new LoginRepository($pdo);
$loginService = new LoginService($loginRepository);
$loginController = new LoginController($loginService);


$logoutController = new LogoutController($loginRepository);