<?php

    session_start();
    if (isset($_SESSION['idUser']) == "") {
      header("Location: login.php");
    }
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['idUser']);
      header("Location: login.php");
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--CSS bootstrap-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <script src="https://kit.fontawesome.com/8fc5187318.js" crossorigin="anonymous"></script>
    <title>Informations sur le patient</title>
   <style>
    body{
        background: #E8F0F2;
    }
    .title h2{
        color: #020f2b;
        text-transform: uppercase;
        margin-left: 20px;
        font-size:40px;
    }
    nav{
        padding: 10px 20px;
    }
    .table-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        
        /*height: 100%;*/
    }

    .dossier_medical {
        margin-left: 50px; /* Adjust the value as needed */
        width: 50%;
    }
    .dossier_medical h2{
        padding-bottom: 15px;
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
    .info {
        justify-content: center;
        align-items: center;
        text-align: center;
        /*background: #020f2b;
        color: #fff;*/
    }
    .info ul {
        list-style: none;
        padding: 50px;
        margin-right: 80px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        font-size: 25px;
    }

    .info ul li {
        margin-right: 20px; /* Adjust the value as needed */
    }
    
   </style>

</head>

<body>
<nav class="nav nav-pills nav-justified">
   <div class="title">
    <h2>MyClinic</h2>
    </div>
  <a class="nav-item nav-link" href="index.php"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Accueil</a>
  <a class="nav-item nav-link active" href="#">Informations du patient</a>
  <a class="nav-item nav-link disabled" href="index.php?logout='1'"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Se déconnecter</a>
</nav>
    
        
        <div class="container">
                <div class="info">
                   <form action="infosPatient.php" method="POST">
                        <?php 
                         require 'config.php';
                         if (isset($_GET['id_patient'])) {
                        
                        $id = $_GET['id_patient'];
                        $show = mysqli_query($con, "SELECT * FROM patient WHERE id_patient='$id'"); 


                        foreach ($show as $row) { ?>
                    <ul>
                        <input type="hidden" name="id_patient" value="<?php echo $_GET['id_patient'] ?>">
                        <li>Patient: <?php echo $row['name'] ?></li>
                        <li>Âge:<?php  
                            $dob= $row['age'];
                            function getAge($dob){
                            $bday= new DateTime($dob);
                            $today = new DateTime(date('d.m.y'));
                            $diff = $today->diff($bday);
                        return $diff->y; } ?>
                        <?php echo getAge($row['age']);?></li>
                        <li>sexe:<?php echo $row['sexe'] ?></li>
                    </ul>
                </div>
                <div class="right-button">
                <a class="btn btn-primary" href="nv_consultation.php?id_patient=<?php echo $row['id_patient']; ?>">Nouvelle consultation</a>
                </div>
                    </form>
                <?php } }?>
            
        </div>

            <!--LISTE DE CONSULTATIONS-->
                <?php
                require 'config.php';
                $id_patient=$_GET['id_patient'];
                $patient_consultation = mysqli_query($con, "SELECT c.id_consultation, c.visit_date, c.diagnosis, c.remarques FROM consultation c
                JOIN patient p ON c.patient_id=p.id_patient WHERE p.id_patient=$id_patient");
                 ?> 
        <div class="table-container">
        <div class="dossier_medical">
                <h2>CONSULTATIONS</h2>
                <table class="table table-bordered">
                    <tr>
                    <th scope="col">DIAGNOSTIQUE</th>
                    <th scope="col">REMARQUES</th>
                    <th scope="col">DATE</th>
                    <th></th>
                    </tr>
                    <tbody>
                        
                  <?php  foreach($patient_consultation as $data) { ?> 
                        <tr>
                        <td><?php echo $data['diagnosis'] ?></td>
                        <td><?php echo $data['remarques'] ?></td>
                        <td><?php echo $data['visit_date'] ?></td>
                        <td>
                        <button class="btn btn-primary prescription-button" data-visit-id="<?php echo $data['id_consultation'] ?>"><i class="fa-solid fa-eye"></i></button>
                        </td>
                        </tr>
                    </tbody>
                </table>
           <?php }  ?>
        </div>
        </div>
    
    

<!-- READ MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Patinet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="addMedication.php" method="POST">
      <div class="modal-body">

      <input type="hidden" name="id_consultation" id="id_consultation">

      
        <div class="form-group">
          <label>Nom</label>
           <input type="text" class="form-control" name="listeMedications" id="listeMedications">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="updatedata" class="btn btn-primary">Enregistrer</button>
      </div>
    </form> 
    </div>
  </div>
</div>
















    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





<script>
    var a=1;
    function data(){
        a++;
        var input = document.createElement("div");
        /*var dtd = '<button class="btn btn-primary"><i class="fa-solid fa-trash"></button>';*/
        input.innerHTML = document.getElementById('subinputs').innerHTML;
        document.getElementById("main").append(input);
    }
</script>

<script>
   function fetchPrescriptionData(visitId) {
  // AJAX request
  $.ajax({
    url: 'fetch_prescription_data.php',
    type: 'GET',
    data: { id_consultation: visitId },
    success: function(response) {
      // Populate the modal with the fetched data
      $('#listeMedications').val(response);

      // Show the modal
      $('#editModal').modal('show');
    },
    error: function() {
      alert('Error occurred while fetching prescription data.');
    }
  });
}

$(document).ready(function() {
  $('.prescription-button').click(function() {
    var visitId = $(this).data('visit-id');

    // Call the function to fetch and display the prescription data
    fetchPrescriptionData(visitId);
  });
});    
</script>

    
             


</body>

</html>