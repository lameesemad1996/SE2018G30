<!--THIS IS THE COURSES WEBPAGE-->

<?php 
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/course.php');
	include_once('./models/student.php');
	include_once('./models/grade.php');

	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
?>
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Grades</span>
		<button class="button float-right edit_grade" id="0">Add Grade</button>
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">Student Name</th>
	      		<th scope="col">Course Name</th>
	      		<th scope="col">Date of Examination</th>
	      		<th scope="col">Degree</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>				<!--table listing all student ids and names and edit and delete buttons-->
		  	<?php	


				$grades = safeGet('choice') == 1 ? Grade::allbygrade(safeGet('keywords')) : Grade::allbyname(safeGet('keywords'));  
				foreach ($grades as $grade) 
				{
					$student = new Student($grade->studentid);
					$course = new Course($grade->courseid);
			?>

    		<tr>
    			<td><?=$grade->id?></td>
    			<td><?=$student->name?></td>
    			<td><?=$course->coursename?></td>
    			<td><?=$grade->dateofexamination?></td>
    			<td><?=$grade->degree?></td>
    			<td>
    				<button class="button edit_grade" id="<?=$grade->id?>">Edit</button>&nbsp;	 <!--// button for editing a student-->

    				<button class="button delete_grade" id="<?=$grade->id?>">Delete</button> 	<!-- // button for deleting a student -->
				</td>
    		</tr>
    		<?php
    		 	} 
    		 ?>
    	</tbody>
    	<tfoot>
    		<form action="/grades.php" class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" name="keywords" placeholder="Search" aria-label="Search" value="">
            <select name="choice">
					<option value="0">Search by Name</option>
					<option value="1">Search by Course</option>

			</select>

            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

     
          	</form>

  		</tfoot>
    </table>
    


<?php include_once('./components/tail.php') ?>



<!--  start of JS script -->

<script type="text/javascript">

	$(document).ready(function()
	{
		$('.edit_grade').click(function(event)
		{
			window.location.href = "editgrade.php?id="+$(this).attr('id');	//byroo7 editstudent.php(w yefta7 new webpage) w y.add el id to url (get method)	
																				//returns the value of the attribute id of $this button which is 
		});
	
		$('.delete_grade').click(function(){
			var anchor = $(this);					//assigns the button clicked as a value for the variable anchor 
			$.ajax									//used to perform asynchronus HTTP request
			({
				url: './controllers/deletegrade.php',			//URL to send the request to (default is current page)
				type: 'GET',									// specifying type of request
				dataType: 'json',								//dataType expected of the server response 
				data: {id: anchor.attr('id')},					//data to send to server: sends student id in key:value form
			})
			.done(function(reponse)								//when response(json data) received, function with response parameter is executed
			{
				if(reponse.status==1) 
				{
					anchor.closest('tr').fadeOut('slow', function() {
						$(this).remove();
					});
				}	
			})
			.fail(function()
			{
				alert("Connection error.");
			})
		});
	});

</script>