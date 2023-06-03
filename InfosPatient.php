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
        position: relative;
        justify-content: flex-start;
        align-items: center;
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
        position:relative;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
    .right-button{
        display: flex;
        justify-content: center;
        padding-bottom:20px;
    }
    .info {
        justify-content: center;
        align-items: center;
        text-align: center;
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
    #Ordonnance{
        display:none;
        position: absolute;
        top: 100px;
        right: 50px;
        margin-top: 100px;
        padding:80px;
        font-size: 24px;
    }
    #Ordonnance textarea{
        background: #E8F0F2;
        color: #023946;
        border: 0;
    }
    #Ordonnance h3{
        font-size: 24px;
        font-weight: bold;
        color: #023946;
        margin: 10px 0;
        line-height: 1.2;
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
                   <form action="InfosPatient.php" method="POST">
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
            </div>
            <div class="right-button">
                <a class="btn btn-primary" href="nv_consultation.php?id_patient=<?php echo $row['id_patient']; ?>">Nouvelle consultation</a>
            </div>
                    </form>
                <?php } }?>
            
        

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
                    <thead>
                    <tr>
                    <th scope="col">DIAGNOSTIQUE</th>
                    <th scope="col">REMARQUES</th>
                    <th scope="col">DATE</th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    
                  <?php  foreach($patient_consultation as $data) { ?> 
                       <tr>   
                        <td><?php echo $data['diagnosis'] ?></td>
                        <td><?php echo $data['remarques'] ?></td>
                        <td><?php echo $data['visit_date'] ?></td>
                        <td>
                        <button class="btn btn-primary prescription-button" value="<?php echo $data['id_consultation'] ?>" onclick="fetchMedications(<?php echo $data['id_consultation'] ?>)"><i class="fa-solid fa-eye"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-primary ordonnancepdf" onclick="redirectToPrescriptionPage('<?php echo $id_patient ?>', '<?php echo $data['id_consultation'] ?>')"><i class="fa-solid fa-file-medical"></i></button>
                        </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
           
        </div>
        </div>
    <div id="Ordonnance">
        <h3>Liste des Médicaments: </h3>
        <textarea id="medicationsInput" cols="30" rows="10" readonly ></textarea>
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
   function fetchMedications(consultationId) {
  // Make an AJAX request to fetch the medications data
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var medications = xhr.responseText;
      document.getElementById("medicationsInput").value = medications;
      document.getElementById("Ordonnance").style.display = "block";
    }
  };
  xhr.open("GET", "fetch_ordonnance.php?id_consultation=" + consultationId, true);
  xhr.send();
}
 
</script>

<script>
    function redirectToPrescriptionPage(id_patient, id_consultation) {
        var url = 'ordonnancepdf.php?id_patient=' + id_patient + '&id_consultation=' + id_consultation;
        window.open(url, '_blank');
    }
</script>
             


</body>

</html>