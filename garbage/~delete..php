<html>
	<head>
		<title>Delete</title>
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
		
		<div class="table" id="ajax_data">
		</div>
		
		<!-- table class="table" style="display: none;">
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
					<td class="hide">1</td>
					<td>Hari Krishnan</td>
					<td>24</td>
					<td>Thrissur</td>
					<td>Programmer</td>
					<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
				</tr>
				<tr>
					<td class="hide">2</td>
					<td>Gopi Nath</td>
					<td>22</td>
					<td>Trivandrum</td>
					<td>Developer</td>
					<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
				</tr>
				<tr>
					<td class="hide">3</td>
					<td>Ajay Raj</td>
					<td>25</td>
					<td>Palakad</td>
					<td>Designer</td>
					<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
				</tr>
				<tr>
					<td class="hide">4</td>
					<td>Ajith Raj</td>
					<td>23</td>
					<td>Coimbatore</td>
					<td>Photoshop</td>
					<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
				</tr>
				<tr>
					<td class="hide">5</td>
					<td>Suresh</td>
					<td>27</td>
					<td>Pollachi</td>
					<td>Designer</td>
					<td class="control-td"><input type="button" class="btn delete-btn" value="X"/></td>
				</tr>
			</tbody>
		</table -->
				
		<div class="clear"> </div>
		
		<div class="hidden-section">
			<span id="err-msg">Data Successfully Deleted.</span>
		</div>
	</body>
	
		<script>
		$( document ).ready(function() {
			var post_data = {
			 'opn' : 'delete'
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
			
			$(".delete-btn").click(function() {
				$(".hidden-section").slideDown();
				//alert($(this).closest("tr").children('td:eq(0)').html());
				$(this).closest("tr").hide();
				$(".hidden-section").fadeOut(3000);
			});
		});
	</script>
	
</html>