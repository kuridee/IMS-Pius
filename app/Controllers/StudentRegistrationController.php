<?php



class StudentRegistrationController{

	private StudentRegistrationService $studentRegistrationService;



	public function __construct(StudentRegistrationService $studentRegistrationService){

		$this->studentRegistrationService = $studentRegistrationService;

	}


	public function Create():void{

		$username = $_POST['username'] ?? '';
		$password = $_POST['password'] ?? '';

		try{

			$saveme = $this->studentRegistrationService->saveStudent($username, $password);

		header('Location:/layered/public/register');
		exit;


		}

		catch(\Exception $e){
			$errorMessage = $e->getMessage();

			require __DIR__ . '/../Views/users/register.php';

		}

		

	}
}


?>