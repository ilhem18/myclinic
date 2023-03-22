<?php 
require 'config.php';

if(isset($_POST['add_btn'])){
    $id_patient=$_GET['id_patient'];
    $date=$_POST['date'];

    $consultation=$_POST['id_consultation'];
    $diagnostique=$_POST['diagnostique'];
    $remarque=$_POST['remarque'];

    for($i=0;$i<count($_POST['main']);$i++){
        $med=$_POST['medicament'][$i];
        $poso=$_POST['posologie'][$i];
        $nbrun=$_POST['nbrunite'][$i];
        $q=$_POST['qsp'][$i];

        $dataarray=array(
            'medicament'=>$med,
            'posologie'=>$poso,
            'nbrunite'=>$nbrun,
            'qsp'=>$q
        );
        if(is_array($dataarray)){
            foreach($dataarray as $row){
                $medicament=mysqli_real_escape_string($con,$row['medicament']);
                $posologie=mysqli_real_escape_string($con,$row['posologie']);
                $nbrunite=mysqli_real_escape_string($con,$row['nbrunite']);
                $qsp=mysqli_real_escape_string($con,$row['qsp']);

                $insordonnance=mysqli_query($con, "INSERT INTO medicament(medication_name, visit_id, posologie, nbrUnite, qsp) VALUES(' $medicament ','$consultation', '$posologie', '$nbrunite', '$qsp')");
                
                if($insordonnance==1){
                $insconsultation=mysqli_query($con,"INSERT INTO consultation(patient_id, visit_date, diagnosis,	remarques,	prescription) VALUES('$id_patient', '$date',  '$diagnostique', '$remarque', '$dataarray')");
                    echo "consultation et ordonnance ajouté";
                    header("Location: index.php");
                } else {
                    echo "erreur";
                }
            }
        } else {
            echo "c'est pas une array";
        }

    }
    
}

?>