<?php
	include_once('database.php');

	class Course extends Database
	{
		function __construct($id) 
		{
			$sql = "SELECT * FROM courses WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) 
			{
				$this->{$key} = $value; 		// obj= new course... obj->coursename = "biology" save();
			}
		}

		public static function getnames()
		{
			$sql = "SELECT coursename FROM courses;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$coursenames = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$coursenames[] = $row['coursename'];
			}
		}

		public static function add($name, $max_degree, $study_years) 
		{
			$sql = "INSERT INTO courses (coursename, maxdegree, studyyears) VALUES (?,?,?)";
			Database::$db->prepare($sql)->execute([$name,$max_degree,$study_years]);
		}
		
		public function delete() 
		{
			$sql = "DELETE FROM courses WHERE id = $this->id;";
			Database::$db->query($sql);
		}

		public function save() 
		{
			$sql = "UPDATE courses SET coursename = ? , maxdegree = ? , studyyears  = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->coursename, $this->maxdegree, $this->studyyears, $this->id]);
		}

		public static function all($keyword) 
		{
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT * FROM courses WHERE coursename like ('%$keyword%');";
			$statement = Database::$db->prepare($sql); //Recheck later
			$statement->execute();
			$courses = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) 
			{
				$courses[] = new Course($row['id']);
			}
			return $courses;
		}
	}
?>