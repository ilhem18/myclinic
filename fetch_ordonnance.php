<?php
// Assuming you're using mysqli for database connection
require 'config.php';
$id_consultation = $_GET['id_consultation'];

// Perform the database query
$stmt = $con->prepare("SELECT listeMedications FROM ordonnance WHERE visit_id = ?");
$stmt->bind_param('i', $id_consultation);
$stmt->execute();
$stmt->bind_result($listeMedications);
$stmt->fetch();

// Return the data
echo $listeMedications;
?>