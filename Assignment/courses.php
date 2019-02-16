<!--THIS IS THE COURSES WEBPAGE-->

<?php 
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/course.php');
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
?>
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Courses</span>
		<button class="button float-right edit_course" id="0">Add Course</button>
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">Course Name</th>
	      		<th scope="col">Max Degree</th>
	      		<th scope="col">Study Years</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>				<!--table listing all student ids and names and edit and delete buttons-->
		  	<?php	
				$courses = Course::all(safeGet('keywords'));  
				foreach ($courses as $course) 
				{
			?>
    		<tr>
    			<td><?=$course->id?></td>
    			<td><?=$course->coursename?></td>
    			<td><?=$course->maxdegree?></td>
    			<td><?=$course->studyyears?></td>
    			<td>
    				<button class="button edit_course" id="<?=$course->id?>">Edit</button>&nbsp;	 <!--// button for editing a student-->

    				<button class="button delete_course" id="<?=$course->id?>">Delete</button> 	<!-- // button for deleting a student -->
				</td>
    		</tr>
    		<?php
    		 	} 
    		 ?>
    	</tbody>
    </table>

<?php include_once('./components/tail.php') ?>



<!--  start of JS script -->

<script type="text/javascript">

	$(document).ready(function()
	{
		$('.edit_course').click(function(event)
		{
			window.location.href = "editcourse.php?id="+$(this).attr('id');	//byroo7 editstudent.php(w yefta7 new webpage) w y.add el id to url (get method)	
																				//returns the value of the attribute id of $this button which is 
		});
	
		$('.delete_course').click(function(){
			var anchor = $(this);					//assigns the button clicked as a value for the variable anchor 
			$.ajax									//used to perform asynchronus HTTP request
			({
				url: './controllers/deletecourse.php',			//URL to send the request to (default is current page)
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