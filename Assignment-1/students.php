<!-- THIS IS THE STUDENTS WEBPAGE-->

<?php 
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/student.php');
	Database::connect('school', 'epiz_22966927', 'VbZpQknX');
?>
	<div style="padding: 10px 0px 10px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">Students</span>
		<button class="button float-right edit_student" id="0">Add Student</button>
	</div>

    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">Name</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>			<!-- table listing all student ids and names and edit and delete buttons-->
		  	<?php	
				$students = Student::all(safeGet('keywords'));  //keywords is the name of the input field expected 
				foreach ($students as $student) 
				{
			?>
    		<tr>
    			<td><?=$student->id?></td>
    			<td><?=$student->name?></td>
    			<td>
    				<button class="button edit_student" id="<?=$student->id?>">Edit</button>&nbsp;	 <!--// button for editing a student-->

    				<button class="button delete_student" id="<?=$student->id?>">Delete</button> 	<!--// button for deleting a student-->
				</td>
    		</tr>
    		<?php
    		 	} 
    		 ?>
    	</tbody>
    </table>

<?php include_once('./components/tail.php') ?>



<script type="text/javascript">

	$(document).ready(function()
	{
		$('.edit_student').click(function(event)
		{
			window.location.href = "editstudent.php?id="+$(this).attr('id');	//byroo7 editstudent.php(w yefta7 new webpage) w y.add el id to url (get method)	
																				//returns the value of the attribute id of $this button which is 
		});
	
		$('.delete_student').click(function(){
			var anchor = $(this);					//assigns the button clicked as a value for the variable anchor 
			$.ajax									//used to perform asynchronus HTTP request
			({
				url: '/controllers/deletestudent.php',			//URL to send the request to (default is current page)
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