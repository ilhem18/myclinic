<?php
require 'config.php';

$nom = "";
$prenom = "";
$age = "";
$sexe = "";

if (isset($_POST['ajout_patient'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$age = $_POST['age'];
	$sexe = $_POST['sexe'];


	
		$query = "INSERT INTO patient(nom, prenom, age, sexe) VALUES ('" . $nom . "', '" . $prenom . "', '" . $age . "', '" . $sexe . "')";
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
?>