<?php
include("db_connector.php");

$opn = $_POST['opn'];

	$sql=mysqli_query($connection_string,"Select * from `sample_table`")or die("Cannot Perform Action!!");
	$row_count = mysqli_num_rows($sql);
	if($row_count){ 
			$table	 =	"<thead>";
			$table	.=	"<tr>";
			$table	.=	"<td class='hide'>Id</td>";
			$table	.=	"<td>Name</td>";
			$table	.=	"<td>Age</td>";
			$table	.=	"<td>Place</td>";
			$table	.=	"<td>Occupation</td>";
			$table	.=	"</tr>";
			$table	.=	"</thead>";
			$table	.=	"<tbody>";
			
			while($row=mysqli_fetch_array($sql)){
				$table .=	"<tr>";
				$table .=	"<td class='hide'>".$row['table_id']."</td>";
				$table .=	"<td>".$row['name']."</td>";
				$table .=	"<td>".$row['age']."</td>";
				$table .=	"<td>".$row['place']."</td>";
				$table .=	"<td>".$row['occupation']."</td>";
				
				if($opn == 'update'){
					$table .=	"<td class='control-td'><input type='button' class='btn update-btn' value='Update'/></td>";
				}
				elseif($opn == 'delete'){
					$table .=	"<td class='control-td'><input type='button' class='btn delete-btn' value='X'/></td>";
				}
				$table .=	"</tr>";
			}
			$table	.=	"</tbody>";
			echo $table;
		} 

?>