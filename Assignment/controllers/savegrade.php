<!-- THIS IS THE PHP CODE THAT SAVES STUDENT WHEN REQUESTED BY EDITSTUDENT WEBPAGE AND RETURNS A HEADER AND A REDIRECT CODE-->


<?php
	include_once("../controllers/common.php");
	include_once("../models/grade.php");
	Database::connect('school', 'epiz_22966927', 'VbZpQknX'); 
	$id = safeGet("id", 0); //gets id sent in URL
	if($id==0) 
	{
		Grade::add(safeGet('studentid', '0'),safeGet('courseid','0'),safeGet('dateofexamination'), safeGet('degree','0'));
	} 
	else 
	{
		$grade = new Grade($id);
		$grade->studentid = safeGet("studentid");
		$grade->courseid = safeGet("courseid");
		$grade->dateofexamination = safeGet("dateofexamination");
		$grade->degree = safeGet("degree");

		$grade->save(); //This is save
	}
	header('Location: ../grades.php'); // sends header to browser as a response to GET request and also returns a REDIRECT status code to browser 

?>
