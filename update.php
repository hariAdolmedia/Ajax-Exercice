<html>
	<head>
		<title>Update</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css"/>
		<script src="js/jquery-1.10.1.js" type="text/javascript"></script>
	</head>
	
	<body>		
		<div class="nav">
			<ul>
				<li><a href="index.php">Create</a></li>
				<li><a href="read.php">Read</a></li>
				<li><a href="update.php">Update</a></li>
				<li><a href="delete.php">Delete</a></li>
			</ul>
		</div>
		
		<div class="table" id="ajax_data">		</div>
		
		<?php
		include("function_files/db_connector.php");

		$sql=mysqli_query($connection_string,"Select * from `sample_table`")or die("Cannot Perform Action!!");
		$row_count = mysqli_num_rows($sql);
		if($row_count){ ?>
			<table class="table">
				<thead>
					<tr>
						<td class="hide">Id</td>
						<td>Name</td>
						<td>Age</td>
						<td>Place</td>
						<td>Occupation</td>
					</tr>
				</thead>
				<tbody>
				<?php while($row=mysqli_fetch_array($sql)){ ?>
					<tr id=<?php echo $row['table_id']; ?>>
						<td class="hide"><?php echo $row['table_id']; ?></td>
						<td class="table_name"><?php echo $row['name']; ?></td>
						<td class="table_age"><?php echo $row['age']; ?></td>
						<td class="table_place"><?php echo $row['place']; ?></td>
						<td class="table_occupation"><?php echo $row['occupation']; ?></td>
						<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>	
		<?php } ?>		
		
		<div class="hidden-section search-data">
			<table>
				<tbody>
					<tr style="display: none;">
						<td>id</td>
						<td><input type="text" name="id_insert" class="input-span text" id="id"/></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><input type="text" name="name_insert" class="input-span text" id="name_id"/></td>
					</tr>
					<tr>
						<td>Age</td>
						<td><input type="text" name="age" class="input-span text"  id="age_id"/></td>
					</tr>
					<tr>
						<td>Place</td>
						<td><input type="text" name="place" class="input-span text"  id="place_id"/></td>
					</tr>
					<tr>
						<td>Occupation</td>
						<td><input type="text" name="occupation" class="input-span text"  id="occupation_id"/></td>
					</tr>
				</tbody>
			</table>
			<input type="button" id="insert-btn" class="btn" value="Update"/>
		</div>
		
		<div class="clear"> </div>
		
		<div class="hidden-section err-data">
			<span id="ret-msg"></span>
		</div>
		
	</body>
			
	<script>
	 /* $( document ).ready(function() {
		var post_data = {
		 'opn' : 'update'
		}
		$.ajax({		
			url     : 'get_list.php',		
			type    : 'POST',		
			data	: post_data,			
			timeout : 30000,			
			success : function( response_data, text, xhrobject ) {	
				if(response_data){	
					$("#ajax_data").html(response_data);
				}
			}
		}); 
	});	*/	
		
		$(".update-btn").click(function() {
			$(".search-data").slideDown();
			var id = $(this).closest("tr").children('td:eq(0)').html();
			var name = $(this).closest("tr").children('td:eq(1)').html();
			var age = $(this).closest("tr").children('td:eq(2)').html();
			var place = $(this).closest("tr").children('td:eq(3)').html();
			var occupation = $(this).closest("tr").children('td:eq(4)').html();
			
			// alert(id+" --- "+name+" --- "+age+" --- "+place+" --- "+occupation);
			
			$('#id').val(id);
			$('#name_id').val(name);
			$('#age_id').val(age);
			$('#place_id').val(place);
			$('#occupation_id').val(occupation);
		});
		
		$("#insert-btn").click(function() {			
				if(($("#name_id").val() != "") && ($("#age_id").val() != "")) {
				var post_data = {
				'id_post'    		: $("#id").val(),
				'name_post'    		: $("#name_id").val(),
				'age_post' 			: $("#age_id").val(),
				'place_post' 		: $("#place_id").val(),
				'occupation_post' 	: $("#occupation_id").val(),
				'opn'				: 'update'
				};
				$.ajax({		
					url     : 'function_files/operations.php',			
					type    : 'POST',			
					data    : post_data,			
					timeout : 30000,			
					success : function( response_data, text, xhrobject ) {	
						if(response_data){	
							$("#ret-msg").html(response_data);
							$(".err-data").slideDown();
							$(".err-data").fadeOut(3000);
							$(".search-data").slideUp();
							edit_row_values($("#id").val(), $("#name_id").val(), $("#age_id").val(), $("#place_id").val(), $("#occupation_id").val());
							//window.location="";  // to refresh
						}
						else{							
							$("#ret-msg").html("Invalid Entry. Please check the Process");
							$(".err-data").slideDown();
							$(".err-data").fadeOut(3000);
						}
					}
				});
			}
			else{						
				$("#ret-msg").html("Insertion Failed.");
				$(".hidden-section").slideDown();
				$(".hidden-section").fadeOut(4000);
			}
		});
		
		// Ascii Value
		// 27 - Esc
		// 13 - Enter
		// 48 -> 57 Numbers(0 to 9)
		$(document).keypress(function(e){
			if(e.keyCode==27){				
				$(".search-data").slideUp();
			}
		});
		
		
		$("#name_id").keypress(function (e) {
			if(e.which == 13){
				$("#insert-btn").click();
			}
		}); 
			
		$("#age_id").keypress(function (e) {
			if(e.which == 13){
				$("#insert-btn").click();
			}
			else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			   return false;
			}
		}); 
		
		$("#place_id").keypress(function (e) {
			if(e.which == 13){
				$("#insert-btn").click();
			}
		}); 
		
		$("#occupation_id").keypress(function (e) {
			if(e.which == 13){
				$("#insert-btn").click();
			}
		}); 
		function edit_row_values(id, name, age, place, occupation){
			
			$("#"+id+" .table_name").html(name);
			$("#"+id+" .table_age").html(age);
			$("#"+id+" .table_place").html(place);
			$("#"+id+" .table_occupation").html(occupation);
			$("#id").val("");
			$("#name_id").val("");
			$("#age_id").val("");
			$("#place_id").val("");
			$("#occupation_id").val("");
		}
	</script>
</html>