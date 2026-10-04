<?php 




class StudentService{

	private StudentRepository $studentRepository;


	public function __construct(StudentRepository $studentRepository){

		$this->studentRepository = $studentRepository;

	}

	public function getStudents():array{

		return $this->studentRepository->getAll();
	}
}



?>