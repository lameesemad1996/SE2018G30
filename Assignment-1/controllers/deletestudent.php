
<?php
	header('Content-Type: application/json; charset=utf-8');	
	include_once("../models/student.php");
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');	
	$student = new Student($_GET['id']);	
	$student->delete();

	/*$response = array('status' => 1);
	echo json_encode($response);*/
	
	echo json_encode(['status'=>1]);			
?>