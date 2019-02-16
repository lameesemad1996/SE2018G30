<!--//THIS IS THE PHP CODE THAT SAVES STUDENT WHEN REQUESTED BY EDITSTUDENT WEBPAGE AND RETURNS A HEADER AND A REDIRECT CODE-->


<?php
	include_once("../controllers/common.php");
	include_once("../models/student.php");
	Database::connect('school', 'epiz_22966927', 'VbZpQknX'); 
	$id = safeGet("id", 0); //gets id sent in URL
	if($id==0) 
	{
		Student::add(safeGet('name'));
	}
	else
	{
		$student = new Student($id);
		$student->name = safeGet("name"); //assigns name sent in URL to new object's name 
		$student->save();
	}
	header('Location: ../students.php'); // sends header to browser as a response to AJAX request and also returns a REDIRECT status code to browser (whats that lol) 
?>