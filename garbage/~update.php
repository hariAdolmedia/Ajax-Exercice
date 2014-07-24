<html>
	<head>
		<title>Update</title>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
		<script src="jquery-1.10.1.js" type="text/javascript"></script>
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
		
		<table class="table" id="ajax_data">
		</table>
		
		<table class="table" style="display:none;">
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
				<tr>
					<td class="hide">100000</td>
					<td>Hari Krishnan</td>
					<td>24</td>
					<td>Thrissur</td>
					<td>Programmer</td>
					<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
				</tr>
				<tr>
					<td class="hide">2</td>
					<td>Gopi Nath</td>
					<td>22</td>
					<td>Trivandrum</td>
					<td>Developer</td>
					<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
				</tr>
				<tr>
					<td class="hide">3</td>
					<td>Ajay Raj</td>
					<td>25</td>
					<td>Palakad</td>
					<td>Designer</td>
					<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
				</tr>
				<tr>
					<td class="hide">4</td>
					<td>Ajith Raj</td>
					<td>23</td>
					<td>Coimbatore</td>
					<td class="control-td">Photoshop</td>
					<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
				</tr>
				<tr>
					<td class="hide">5</td>
					<td>Suresh</td>
					<td>27</td>
					<td>Pollachi</td>
					<td>Designer</td>
					<td class="control-td"><input type="button" class="btn update-btn" value="Update"/></td>
				</tr>
			</tbody>
		</table>
		
		
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
	 $( document ).ready(function() {
		$.ajax({		
			url     : 'get_list.php',			
			timeout : 30000,			
			success : function( response_data, text, xhrobject ) {	
				if(response_data){	
					$("#ajax_data").html(response_data);
				}
			}
		}); 
		
		
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
					url     : 'db_connection.php',			
					type    : 'POST',			
					data    : post_data,			
					timeout : 30000,			
					success : function( response_data, text, xhrobject ) {	
						if(response_data){	
							$(".search-data").slideUp();
							$("#id").val("");
							$("#name_id").val("");
							$("#age_id").val("");
							$("#place_id").val("");
							$("#occupation_id").val("");
							$("#ret-msg").html(response_data);
							$(".err-data").slideDown();
							$(".err-data").fadeOut(3000);
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
		
		$(document).keypress(function(e){
			if(e.keyCode==27){				
				$(".search-data").slideUp();
			}
		});
		
		$("#age_id").keypress(function (e) {
			 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					   return false;
			}
		}); 
		
	});
	</script>
</html>