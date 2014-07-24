<html>
	<head>
		<title>Delete</title>
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
					<tr>
						<td class="hide"><?php echo $row['table_id'];?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['age'];?></td>
						<td><?php echo $row['place'];?></td>
						<td><?php echo $row['occupation'];?></td>
						<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>	
		<?php } ?>	
		
		<div class="clear"> </div>
		
		<div class="hidden-section">
			<span id="err-msg"></span>
		</div>
	</body>
	
		<script>
		// Getting the table through ajax on doc ready
		/* $( document ).ready(function() {
			var post_data = {
			 'opn' : 'delete'
			}
			$.ajax({		
				url     : 'function_files/get_list.php',		
				type    : 'POST',		
				data	: post_data,			
				timeout : 30000,			
				success : function( response_data, text, xhrobject ) {	
					if(response_data){	
						$("#ajax_data").html(response_data);
					}
				}
			}); 
		}); */
			
			$(".delete-btn").click(function() {
				var id_post = $(this).closest("tr").children('td:eq(0)').html();
				var post_data = {
					'opn' 		: 'delete',
					'id_post'	: id_post
				};
				var that = this;
			$.ajax({		
				url     : 'function_files/operations.php',		
				type    : 'POST',		
				data	: post_data,			
				timeout : 30000,			
				success : function( response_data, text, xhrobject ) {	
					if(response_data){	
						//$(that).closest("tr").hide();
						$(".hidden-section").slideDown();
						$("#err-msg").html(response_data);
						$(".hidden-section").fadeOut(3000);
						window.location="";
					}
				}
			}); 
			});
	</script>
	
</html>