<?php
include("db_connector.php");

$opn = $_POST['opn'];
if($opn == 'create'){
// ---------------------------------------------------------------------
/* ------------------------ TO INSERT THE VALUES ----------------------- */
// ---------------------------------------------------------------------
		$name       = $_POST['name_post'];
		$age        = $_POST['age_post'];
		$place      = $_POST['place_post'];
		$occupation = $_POST['occupation_post'];
		$sql=mysqli_query($connection_string,"INSERT into `sample_table` (`name`,`age`,`place`,`occupation`) VALUES ('".$name."', '".$age."', '".$place."', '".$occupation."')")or die("Cannot Perform Action!!");
		echo "Data inserted Successfully!!";
} 

elseif($opn == 'read'){
// -------------------------------------------------------------------
/* ----------------------- TO GET A ROW VALUE ------------------------ */
// -------------------------------------------------------------------
	$name       = $_POST['name_post'];
	$sql1=mysqli_query($connection_string,"Select * from `sample_table` WHERE `name`  = '".$name."'")or die("Cannot Perform Action!!");
	$get_data	=	mysqli_fetch_array($sql1);	
	if($get_data){
		$data['get_name']			=	$get_data["name"];
		$data['get_age']			=	$get_data["age"];
		$data['get_place']			=	$get_data["place"];
		$data['get_occupation']		=	$get_data["occupation"];
		$data['response']			= 	"Data Found";
		echo json_encode($data);
	}
} 

elseif($opn == 'update'){
// -------------------------------------------------------------------------------------------------
/* ------------------  TO UPDATE VALUES IN A ROW OF THE DATABASE FROM THE FRONT END ---------------- */
// -------------------------------------------------------------------------------------------------
	$id			= $_POST['id_post'];
	$name       = $_POST['name_post'];
	$age        = $_POST['age_post'];
	$place      = $_POST['place_post'];
	$occupation = $_POST['occupation_post'];
	$sql2=mysqli_query($connection_string,"UPDATE `sample_table` SET `name` = '".$name."', `age` = '".$age."', `place` = '".$place."', `occupation` = '".$occupation."' WHERE `table_id` = '".$id."'")or die("Cannot Perform Action!!");
	if($sql2){
		echo "Update made Successfully!!";
	}
	else{
		echo "Insertion failed due to some technical reasons.";
	}
} 

elseif($opn == 'delete'){
// ------------------------------------------------------------------------------------------
/* -------------------  TO DELETE A ROW IN THE DATABASE FROM THE FRONT END ------------------ */
// ------------------------------------------------------------------------------------------
	$id     = $_POST['id_post'];
	$sql4	= mysqli_query($connection_string,"DELETE from `sample_table` WHERE `table_id`  = '".$id."'")or die("Cannot Perform Action!!");
	if($sql4){
		echo "Deleted Successfully!!";
	}
}
?>