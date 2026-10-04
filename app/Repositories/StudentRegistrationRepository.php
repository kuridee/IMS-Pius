<?php 



class StudentRegistrationRepository{


	private PDO $pdo;

	public function __construct(PDO $pdo){

		$this->pdo = $pdo;



	}

	public function Save($username, $password){

		$sql = "INSERT INTO users (Username, Password) VALUES (:username, :password)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([
			'username' => $username,
			'password' => $password

		]);

	}
}


?>