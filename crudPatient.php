<?php
require 'config.php';

$name = "";
$age = "";
$sexe = "";

if (isset($_POST['ajout_patient'])) {
	$name = $_POST['name'];
	$age = $_POST['age'];
	$sexe = $_POST['sexe'];


	
		$query = "INSERT INTO patient(name, age, sexe) VALUES ('" . $name . "',  '" . $age . "', '" . $sexe . "')";
			$run = mysqli_query($con, $query);
			if($run){
				echo "<script> alert('patient ajouté!');</script>";
				header("Location: index.php");
			}
	
}
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$delete = mysqli_query($con, "DELETE FROM patient WHERE id_patient = '$id'");

	if($delete){
		header("Location: index.php");
	}
}


if(isset($_POST['updatedata'])){

	$id=$_POST['update_id'];


	$name= $_POST['name'];
	$age= $_POST['age'];
	$sexe=$_POST['sexe'];

	$update= mysqli_query($con, "UPDATE patient SET name= '$name', age='$age', sexe='$sexe' WHERE id_patient='$id'");
	if($update){
		header("Location: index.php");
	}
}

?>