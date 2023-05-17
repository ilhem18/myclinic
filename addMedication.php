<?php 
require 'config.php';

if(isset($_POST['add_btn']) && isset($_POST['id_patient'])){
    $id_patient = $_POST['id_patient'];

    $diagnostique=$_POST['motif'];
    $remarque=$_POST['remarque'];

   
    

	$run = mysqli_query($con, "INSERT INTO consultation(patient_id,	visit_date,	diagnosis,	remarques) VALUES ('$id_patient',  CURRENT_TIMESTAMP, '$diagnostique','$remarque')");
        $id_consultation = mysqli_insert_id($con);    
      
        $ordo=mysqli_query($con, "INSERT INTO ordonnance(visit_id) VALUES ('$id_consultation')");
            $prescription_id = mysqli_insert_id($con);
           
        
            $medications = $_POST['medications'];

            // Iterate over the medications and insert medication names into the `medication` table
            $medicationIds = array();
            foreach ($medications as $medication) {
                $medicationName = mysqli_real_escape_string($con, $medication['med_name']);
                
                // Insert the medication name into the `medication` table
                $insertQuery = "INSERT INTO medicament (medication_name) VALUES ('$medicationName')";
                $insertResult = mysqli_query($con, $insertQuery);
                if ($insertResult) {
                    // Retrieve the inserted medication's id_medication
                    $medicationId = mysqli_insert_id($con);
                    $medicationIds[] = $medicationId;
                } else {
                    echo "Error inserting medication: " . mysqli_error($con);
                }
            }
            
            // Insert medication details into the `medicament_patient` table
            foreach ($medications as $index => $medication) {
                $posologie = mysqli_real_escape_string($con, $medication['posologie']);
                $nbrunite = mysqli_real_escape_string($con, $medication['nbrunite']);
                $qsp = mysqli_real_escape_string($con, $medication['qsp']);
                $medicationId = $medicationIds[$index];
            
                $insertQuery = "INSERT INTO medicament_patient (id_ordonnance, id_medication, posologie, qsp, nbrunite) VALUES ('$prescription_id', '$medicationId', '$posologie', '$qsp', '$nbrunite')";
                $insertResult = mysqli_query($con, $insertQuery);
                if (!$insertResult) {
                    echo "Error inserting medication details: " . mysqli_error($con);
                } else {
                    header("Location: index.php");
                }
            }
            
            

            
    }











 /*get the IDs of the selected medications 
            $medications = $_POST['medications'];   
            
       
            //insert each medication into the patient_medication table
            foreach($medications as $medication){
                $medication_name = mysqli_real_escape_string($con, $medication['med_name']);
                $posologie = mysqli_real_escape_string($con, $medication['posologie']);
                $nbrunite = mysqli_real_escape_string($con, $medication['nbrunite']);
                $qsp = mysqli_real_escape_string($con, $medication['qsp']);
            
               /*for($i=0; $i<count($medication_names); $i++){
                $medication_name = $medication_names[$i];
                $posologie = $posologies[$i];
                $nbrunite = $nbrunites[$i];
                $qsp = $qsps[$i]; }

                $liste_medicament=mysqli_query($con, "INSERT INTO medicament_patient(id_ordonnance, med_name, posologie, qsp, nbrunite) VALUES ('$prescription_id', '$medication_name', '$posologie', '$qsp', '$nbrunite')");


              
            }*/


?>


