<!-- THIS IS THE EDIT WEBPAGE-->


<?php 
	include_once("./controllers/common.php");
	include_once('./components/head.php');
	include_once('./models/course.php');
	$id = safeGet('id');		
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
	$course = new Course($id);
?>

    <h2 class="mt-4"> <?=($id)?"Edit":"Add"?> Course</h2>

    <form action="controllers/savecourse.php" method="post">
    	<input type="hidden" name="id" value= "<?=$course->get('id')?>">  
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="coursename" value="<?=$course->get('coursename')?>" required>
					</div>
					<label for="inputEmail3" class="col-sm-2 col-form-label">Max Degree</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="maxdegree" value="<?=$course->get('maxdegree')?>" required>
					</div>
					<label for="inputEmail3" class="col-sm-2 col-form-label">Study Years</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="studyyears" value="<?=$course->get('studyyears')?>" required>
					</div>
					
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button> 
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>