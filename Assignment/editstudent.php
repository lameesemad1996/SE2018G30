<!-- THIS IS THE EDIT/ADD WEBPAGE--> 


<?php 
	include_once("./controllers/common.php");
	include_once('./components/head.php');
	include_once('./models/student.php');
	$id = safeGet('id');		//lessa bashoof
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
	$student = new Student($id);
?>

    <h2 class="mt-4"> <?=($id)?"Edit":"Add"?> Student</h2>

    <form action="controllers/savestudent.php" method="post">
    	<input type="hidden" name="id" value= "<?=$student->get('id')?>" >  <!-- sends a hidden information field containing student's id to savestudent.php 																				to perform editing/adding ana msh fahma anhy-->
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="name" value="<?=$student->get('name')?>" required>
					</div>
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button>    <!-- // submits form details to action attribute's URL-->
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>