<?php
include("db_connector.php");

$sql=mysqli_query($connection_string,"Select name from `sample_table` WHERE name LIKE '%".$_REQUEST['term']."%'")or die("Cannot Perform Action!!");
$row_count = mysqli_num_rows($sql);
if($row_count){ 
	while($row=mysqli_fetch_array($sql)){
		$results[] = array('label' => $row['name']);
	}
}
echo json_encode($results);
flush();
?>