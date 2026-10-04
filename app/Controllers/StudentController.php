<?php



class StudentController{

	private StudentService $studentService;



public function __construct(StudentService $studentService){

	$this->studentService = $studentService;


}

public function student():void{

	$student =  $this->studentService->getStudents();

	require __DIR__ .  '/../Views/users/student.php';


}

}


?>