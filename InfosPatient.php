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
    <title>Informations sur le patient</title>
    <!--CSS bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <script src="https://kit.fontawesome.com/8fc5187318.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="infosPatient.css">

</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>MyClinic</h2>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Accueil</a></li>
                <li><a href="index.php?logout='1'"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Se déconnecter</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <h2>Infos général</h2>
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
                        <li>Âge:<?php echo getAge($row['age']); ?></li>
                        <li>sexe:<?php echo $row['sexe'] ?></li>
                    </ul>
                    <div class="top-right">
            <!--<button type="submit"><a href="nv_consultation.php">Nouvelle consultation</a></button>-->
            <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#ConsultationModal_<?php echo $row['id_patient']; ?>">Nouvelle consultation</buton>
        </div>
                    </form>
                <?php } }?>
                </div>
                <?php
                require 'config.php';
                $count = mysqli_query($con, "SELECT * FROM consultation");
                if(mysqli_num_rows($count) > 0) { ?>
                <?php
                "<div class='derniere-consultation'>
                    <a href=''>11/01/2023</a>
                </div>
            </div>
        </div>
        <div class='dossier_medical'>
            <div class='consultation_motif'>
                <h2>Consultation 11/01/2023</h2>
                <ul>
                    <li>Motif: </li>
                    <li>Diagnostique médical: </li>
                    <li>Poids: </li>
                    <li>Taille: </li>
                    <li>Température: </li>
                    <li>Fréquence cardiaque: </li>
                    <li>pression artérielle: </li>
                </ul>
            </div>"; }?>
            <?php 
            require 'config.php';
            $count = mysqli_query($con, "SELECT * FROM ordonnance");
            if(mysqli_num_rows($count) > 0) { ?>
            <?php 
            "<div class='Ordonnance'>
                <h2>Ordonnance 11/01/2023</h2>
                <table class='table'>
                    <thead class='thead-light'>
                        <tr>
                            <th scope='col'>Médicament</th>
                            <th scope='col'>Posologie</th>
                            <th scope='col'>Nbr d'unité</th>
                            <th scope='col'>Qsp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>"; ?>
        <?php } ?>
        
    </div>

<!--Modal consultation + ordonnance-->
<div class="modal fade" id="ConsultationModal_<?php echo $row['id_patient']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvelle consultation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form method="POST" action="addMedication.php">
        <div class="form-row">
        <div class="form-group col-7">
            <label for="">Patient</label>
            <input type="text" class="form-control" value="<?php  echo $row['name'];?>" readonly>
        </div>
        <div class="form-group col-7">
            <label for="">Age</label>
            <input type="text" class="form-control" value="<?php  
            $dob= $row['age'];
        function getAge($dob){
            $bday= new DateTime($dob);
            $today = new DateTime(date('d.m.y'));
            $diff = $today->diff($bday);
            return $diff->y; } ?>
            <?php echo getAge($row['age']);?>
       " readonly>
        </div>
        <div class="form-group col-7">
            <label for="">Date</label>
            <input type="text" class="form-control" value="<?php date_default_timezone_set('Africa/Algiers');
             echo date("d-m-y H:i:s");?>" readonly>
        </div>
        </div>

    <br>
        <div class="form-row">
        <div class="form-group col-7">
        <label>Diagnostique &nbsp;&nbsp;</label>
        <input type="text" class="form-control">
        </div>
        <div class="form-group col">
        <label>Remarques &nbsp;&nbsp;</label>
        <textarea class="form-control"></textarea>
        </div>
        </div>
    </form>
    <br>
    <div class="ordonnance">
        <h4>Ordonnance</h4>
        <table class="table" id="tbl">
        <thead>
                <th scope="col">Médicament</th>
                <th scope="col">Posologie</th>
                <th scope="col">Nbr d'unité</th>
                <th scope="col">Qsp</th>
                <th scope="col" colspan="2"></th>
        </thead>
        <tbody>
        </tbody>
        </table>
    <form method="POST" name="sample">
        <div class="form-row">
        <div class="col">
        <input type="text" class="form-control" name="medicament">
        </div>
        <div class="col">
        <input type="text" class="form-control" name="posologie">
        </div>
        <div class="col">
        <input type="text" class="form-control" name="nbrunite">
        </div>
        <div class="col">
        <input type="text" class="form-control" name="qsp">
        </div>
        </div>
        <button type="submit" name="ajout_medicament" class="btn btn-primary" onclick="addMedicament();">+</button>
    </form>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Aperçu</button>
      </div>
    </div>
  </div>
</div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function addMedicament() {
        var medicament = document.sample.medicament.value;
        var posologie = document.sample.posologie.value;
        var nbrunite = document.sample.nbrunite.value;
        var qsp = document.sample.qsp.value;

        var tr = document.createElement('tr');

        var td1 = tr.appendChild(document.createElement('td'));
        var td2 = tr.appendChild(document.createElement('td'));
        var td3 = tr.appendChild(document.createElement('td'));
        var td4 = tr.appendChild(document.createElement('td'));

        td1.innerHTML= medicament;
        td2.innerHTML= posologie;
        td3.innerHTML= nbrunite;
        td4.innerHTML= qsp;

        document.getElementById("tbl").appendChild(tr);
    }
</script>



</body>

</html>