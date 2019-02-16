<!-- THIS IS THE PHP CODE THAT SAVES STUDENT WHEN REQUESTED BY EDITSTUDENT WEBPAGE AND RETURNS A HEADER AND A REDIRECT CODE-->


<?php
	include_once("../controllers/common.php");
	include_once("../models/course.php");
	Database::connect('school', 'epiz_22966927', 'VbZpQknX'); 
	$id = safeGet("id", 0); //gets id sent in URL
	if($id==0) 
	{
		Course::add(safeGet('coursename', 'name'),safeGet('maxdegree','100'),safeGet('studyyears','5'));
	} 
	else 
	{
		$course = new Course($id);
		$course->coursename = safeGet("coursename");
		$course->maxdegree = safeGet("maxdegree");
		$course->studyyears = safeGet("studyyears");

		$course->save(); //This is save
	}
	header('Location: ../courses.php'); // sends header to browser as a response to GET request and also returns a REDIRECT status code to browser 

?>
