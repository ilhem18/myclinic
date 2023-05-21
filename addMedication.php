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
           
        
           //loop through the medication inputs and inserrt into the medication table
           $nameMeds = $_POST['med_name'];
           $posologies = $_POST['posologie'];
           $qspValues = $_POST['qsp'];
           $nbrUnites= $_POST['nbrunite'];

           for($i = 0; $i < count($nameMeds); $i++){
            $nameMed = $nameMeds[$i];
            $posologie = $posologies[$i];
            $qsp = $qspValues[$i];
            $nbrUnite = $nbrUnites[$i];
           }
           $liste_medicament=mysqli_query($con, "INSERT INTO medicament_patient(id_ordonnance, med_name, posologie, qsp, nbrunite)
            VALUES ('$prescription_id', '$nameMed', '$posologie', '$qsp', '$nbrUnite')");

        if($liste_medicament){
            header("Location: index.php");
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


