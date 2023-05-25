<?php 
require 'config.php';

if(isset($_POST['add_btn']) && isset($_POST['id_patient'])){
    $id_patient = $_POST['id_patient'];

    $diagnostique=$_POST['motif'];
    $remarque=$_POST['remarque'];

   
    

	$run = mysqli_query($con, "INSERT INTO consultation(patient_id,	visit_date,	diagnosis,	remarques) VALUES ('$id_patient',  CURRENT_TIMESTAMP, '$diagnostique','$remarque')");
        $id_consultation = mysqli_insert_id($con);    

        /*afficher la date de la derniere consultation
        $derniere_consultation= "SELECT visit_date FROM consultation WHERE id_consultation='$id_consultation'";
        $resultat=mysqli_query($con,$derniere_consultation);*/

          
        $listeMedications=$_POST['textarea_data'];
        $ordo=mysqli_query($con, "INSERT INTO ordonnance(visit_id, listeMedications) VALUES ('$id_consultation','$listeMedications')");
            //$prescription_id = mysqli_insert_id($con);
        if($ordo){
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


