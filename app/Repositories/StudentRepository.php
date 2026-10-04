<?php

class StudentRepository{

	private PDO $pdo;

	public function __construct(PDO $pdo){

		$this->pdo =  $pdo;

	}


	public function getAll(): array{

		$sql = "SELECT id, Username FROM student ORDER BY id DESC";

		$stmt = $this->pdo->query($sql);
		return $stmt->fetchAll(PDO:: FETCH_ASSOC);


	}
}





?>