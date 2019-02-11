<?php
	include_once('database.php');
	include_once('student.php');
	include_once('course.php');

	class Grade extends Database
	{
		function __construct($id) 
		{
			$sql = "SELECT * FROM grades WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) 
			{
				$this->{$key} = $value; 		// obj= new course... obj->coursename = "biology" save();
			}
		}

		public function getcoursename()
		{
			$course = new Course($this->$courseid);
			return $course->coursename;
		}
		public function getstudentname()
		{
			$student = new Student($this->$studentid);
			return $student->name;
		}

		public static function add($studentid, $courseid, $dateofexamination, $degree) 
		{
			$sql = "INSERT INTO grades (studentid, courseid, dateofexamination, degree) VALUES (?,?,?,?)";
			Database::$db->prepare($sql)->execute([$studentid,$courseid,$dateofexamination,$degree]);
		}
		
		public function delete() 
		{
			$sql = "DELETE FROM grades WHERE id = $this->id;";
			Database::$db->query($sql);
		}

		public function save() 
		{
			$sql = "UPDATE grades SET studentid = ? , courseid = ? , dateofexamination  = ? , degree = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->studentid, $this->courseid, $this->dateofexamination, $this->degree, $this->id]);
		}

		public static function allbygrade($keyword) 
		{
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT * FROM courses JOIN grades ON courses.id = grades.courseid WHERE coursename like ('%$keyword%')";
			$statement = Database::$db->prepare($sql); 
			$statement->execute();
			$grades = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$grades[] = new Grade($row['id']);
			}
			return $grades;
		}

		public static function allbyname($keyword) 
		{
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT * FROM students JOIN grades ON students.id = grades.studentid WHERE name like ('%$keyword%')";
			$statement = Database::$db->prepare($sql); 
			$statement->execute();
			$grades = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$grades[] = new Grade($row['id']);
			}
			return $grades;
		}

	}
?>