<html>
	<head>
		<title>Insert</title>
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
		
		<div class="head-section1">
			<span>Insert and Save your Values :</span>			
		</div>
		
		<div class="control-section">
			<table> 
				<tbody>
					<tr>
						<td>Name</td>
						<td><input type="text" name="name_insert" class="input-span text" id="name_id"/></td>
					</tr>
					<tr>
						<td>Age</td>
						<td><input type="text" name="age" class="input-span text" maxlength="2" id="age_id"/></td>
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
			<input type="button" id="insert-btn" class="btn" value="Insert"/>
		</div>
		
		<div class="clear"> </div>
		
		<div class="hidden-section" style="margin-top: 15px;">
			<span id="ret-msg"></span>
		</div>
	</body>
	
	<script>
		$("#insert-btn").click(function() {
			if(($("#name_id").val() != "") && ($("#age_id").val() != "")) {
				var post_data = {
				'name_post'    		: $("#name_id").val(),
				'age_post' 			: $("#age_id").val(),
				'place_post' 		: $("#place_id").val(),
				'occupation_post' 	: $("#occupation_id").val(),
				'opn'				: 'create'
				};
				$.ajax({		
					url     : 'function_files/operations.php',			
					type    : 'POST',			
					data    : post_data,			
					timeout : 30000,			
					success : function( response_data, text, xhrobject ) {	
						if(response_data){	
							$("#name_id").val("");
							$("#age_id").val("");
							$("#place_id").val("");
							$("#occupation_id").val("");
							$("#ret-msg").html(response_data);
							$(".hidden-section").slideDown();
							$(".hidden-section").fadeOut(3000);
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
		
	</script>
	
</html>