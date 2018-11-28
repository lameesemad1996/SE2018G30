<!-- THIS IS THE EDIT WEBPAGE-->


<?php 
	include_once("./controllers/common.php");
	include_once('./components/head.php');
	include_once('./models/grade.php');
	include_once('./models/course.php');
	include_once('./models/student.php');

	$id = safeGet('id');		
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
	$grade = new Grade($id);
?>

    <h2 class="mt-4"> <?=($id)?"Edit":"Add"?> Grade</h2>

    <form action="controllers/savegrade.php" method="post">
    	<input type="hidden" name="id" value= "<?=$grade->get('id')?>">  
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					
					<label for="inputEmail3" class="col-sm-2 col-form-label">Student Name</label>
					<div class="col-sm-10">
						<select name="studentid">
							<?php 
								$students = Student::all(null);  
								foreach ($students as $student)
								{ 
								?>
								<option value="<?=$student->id?>"><?php echo $student->name?></option>
							<?php
								}
							?>
						</select>
					</div>

					<label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
					<div class="col-sm-10">
						<select name="courseid">
							<?php 
								$courses = Course::all(null);  
								foreach ($courses as $course)
								{ 
								?>
								<option value="<?=$course->id?>"><?php echo $course->coursename?></option>
							<?php
								}
							?>
						</select>
					</div>

					<label for="inputEmail3" class="col-sm-2 col-form-label">Date of Examination</label>
					<div class="col-sm-10">
						<input class="form-control" type="date" name="dateofexamination" value="<?=$grade->get('dateofexamination')?>" required>
					</div>

					<label for="inputEmail3" class="col-sm-2 col-form-label">Degree</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="degree" value="<?=$grade->get('degree')?>" required>
					</div>
					
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button> 
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>