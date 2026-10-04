<?php 


class StudentRegistrationService{

	private StudentRegistrationRepository $studentRegistrationRepository;

	public function __construct(StudentRegistrationRepository $studentRegistrationRepository){

		$this->studentRegistrationRepository = $studentRegistrationRepository;
	}

	public function saveStudent(string $username, string $password){

		$hasMinlenght = strlen($password) >= 8;
		$hasUppercase = preg_match('/[A-Z]/', $password);
		$hasNumber = preg_match('/[0-9]/', $password);
		$hasSpecialChar = preg_match('/[!@#%&*()\-_=+{};:,<.>~]/', $password);

		if(!$hasMinlenght || !$hasUppercase || !$hasNumber || !$hasSpecialChar){

			throw new \Exception("Password must include at least one uppercase, letter, one mnumber, and one special character");
		}

		$hashPassword = password_hash($password, PASSWORD_DEFAULT);

		return $this->studentRegistrationRepository->Save($username, $hashPassword);
	}
}



?>