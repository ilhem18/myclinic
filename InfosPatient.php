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
                    <?php
                    require 'config.php';
                    $id = $_GET['id_patient'];

                    $show = mysqli_query($con, "SELECT * FROM patient WHERE id_patient='$id'"); 

                    ?>
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
                        <li>Âge:<?php echo $row['age'] ?></li>
                        <li>sexe:<?php echo $row['sexe'] ?></li>
                    </ul>
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
            </div>
            <div class='Ordonnance'>
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
        <div class="top-right">
            <button type="submit"><a href="nv_consultation.php">Nouvelle consultation</a></button>
        </div>
    </div>













    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>