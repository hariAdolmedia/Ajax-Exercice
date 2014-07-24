<html>
	<head>
		<title>Read</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css"/>
		 <link rel="stylesheet" href="css/jquery.ui.autocomplete.css" type="text/css" />
		 <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
		 <link rel="stylesheet" href="css/custom.css" type="text/css" />
		<script src="js/jquery-1.10.1.js" type="text/javascript"></script>
		<script src="js/jquery-ui.js" type="text/javascript"></script>
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
		
		<div class="head-section1">
			<div class="unit-section">
				<span class="label">Enter the Name:</span>
				<input type="text" name="name_insert" class="input-span text" id="name_id"/>
				<input type="button" id="search-btn" class="btn" value="Search"/>
			</div>
		</div>
		
		<table class="table" style="display: none;">
			<tbody>
				<tr>
					<td>Name</td>
					<td id="name_get"></td>
				</tr>
				<tr>
					<td>Age</td>
					<td id="age_get"></td>
				</tr>
				<tr>
					<td>Place</td>
					<td id="place_get"></td>
				</tr>
				<tr>
					<td>Occupation</td>
					<td id="occupation_get"></td>
				</tr>
			</tbody>
		</table>
		
		<div class="clear"> </div>
		<div class="hidden-section">
			<span id="ret-msg"></span>
		</div>
	</body>
		
	<script>
		$("#search-btn").click(function() {
		if($("#name_id").val() != ""){		
			var post_data = {	
				'name_post'    		: $("#name_id").val(),
				'opn'				: 'read'
			};
			$.ajax({		
				url     : 'function_files/operations.php',			
				type    : 'POST',			
				data    : post_data,			
				timeout : 30000,			
				success : function( response_data, text, xhrobject ) {	
					if(response_data){	
						var data = JSON.parse(response_data);
						$(".table").slideDown();				
						$("#name_id").val("");
						$("#name_get").html(data['get_name']);
						$("#age_get").html(data['get_age']);
						$("#place_get").html(data['get_place']);
						$("#occupation_get").html(data['get_occupation']);
						$(".hidden-section").slideDown();
						$("#ret-msg").html(data['response']);
						$(".hidden-section").fadeOut(3000);
					}
					else{		
						$("#name_id").val("");
						$(".table").slideUp();
						$(".hidden-section").slideDown();
						$("#ret-msg").html("No such records found. Please check the data.");
						$(".hidden-section").fadeOut(4000);
					}					
				}
			});
		}
		else{		
			$(".table").slideUp();
			$("#name_id").val("");
			$(".hidden-section").slideDown();
			$("#ret-msg").html("Please seach for valid data. The column is Empty.");
			$(".hidden-section").fadeOut(4000);
		}
		});
		
				
		$("#name_id").keypress(function (e) {
			if(e.which == 13){
				$("#search-btn").click();
			}
		}); 
		
		$(function() {
			$( "#name_id" ).autocomplete({
				 source:'function_files/get_names.php',
			});
		});
	</script>
</html>