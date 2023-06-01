<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <script src="https://kit.fontawesome.com/8fc5187318.js" crossorigin="anonymous"></script>
    <title>Nouvelle consultation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            list-style: none;
            text-decoration: none;
        }

        body {
            background: #E8F0F2;
        }
        .wrapper{
        display: flex;
        position: relative;
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
        .wrapper .main_content {
            width: 100%;
        }

        .wrapper .main_content .header {
            width: 90%;
            /*height: 350px;*/
            margin-top: 20px;
            margin-left: 70px;
            padding: 30px;
            color: #717171;
            border-bottom: 2px solid #e0e4e8;
        }

        .wrapper .top-right button a:hover {
            text-decoration: none;
        }

        .wrapper .dossier_medical {
            padding-bottom: 50px;
            margin-left: 70px;
            width: 90%;
            background: #fff;
            text-align: center;
            justify-content: center;
            border-bottom: 5px solid #e0e4e8;
        }

        .wrapper .dossier_medical h4{
            padding: 30px;
        }
        .wrapper .dossier_medical button {
            padding: 20px 0;
            margin: 10px;
            width: 250px;
            background: #5F93CC;
            color: #f3f5f9;
            font-size: 20px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
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
    <div class="wrapper">
        <div class="main_content">
            <div class="header">
                <h2>Général</h2>
                <form action="addMedication.php" method="POST">
                <?php 
                         require 'config.php';
                         if (isset($_GET['id_patient'])) {
                        
                        $id = $_GET['id_patient'];
                        $show = mysqli_query($con, "SELECT * FROM patient WHERE id_patient='$id'"); 

                        foreach ($show as $row) { ?>
                    <div class="form-row">
                        <input type="hidden" name="id_patient" id="id_patient" value="<?php echo $row['id_patient']; ?>">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="age" id="age" value ="<?php  
                                                                            $dob= $row['age'];
                                                                            function getAge($dob){
                                                                            $bday= new DateTime($dob);
                                                                            $today = new DateTime(date('d.m.y'));
                                                                            $diff = $today->diff($bday);
                                                                            return $diff->y; } ?>
                            <?php echo getAge($row['age']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                         <input type="text" class="form-control" name="date" id="date" value="<?php date_default_timezone_set('Africa/Algiers');
                             echo date("d-m-y H:i:s");?>" readonly>
                        </div>
                        <input type="hidden" name="id_consultation" id="id_consultation">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="motif" id="motif"  placeholder="Motif">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="remarque" id="remarque"  placeholder="Remarques">
                        </div>
                    </div>
                <?php }} ?>
            </div>
            <div class="dossier_medical">
            <div class="ordonnance">
                <h4>Ordonnance</h4>
                <input type="hidden" name="id_ordonnance" id="id_ordonnance">
                <div class="form-group">     
                    <textarea name="textarea_data" rows="5" cols="100"></textarea>
                </div>
            </div>
            <button name="add_btn">Sauvegarder</button>
            </div>
            <div class="top-right">
                
            </div>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
 
function addMedication() {
    
    var medicationsContainer = document.querySelector('[name="medications[]"]');
    
    // Create a new medication row
    var row = document.createElement('div');
    row.classList.add('row');

    // Create medication name field
    var medNameCol = document.createElement('div');
    medNameCol.classList.add('col');
    var medNameInput = document.createElement('input');
    medNameInput.type = 'text';
    medNameInput.classList.add('form-control');
    medNameInput.placeholder = 'Médicament';
    medNameInput.name = 'medications[med_name]';
    medNameCol.appendChild(medNameInput);
    row.appendChild(medNameCol);

    // Create posologie field
    var posologieCol = document.createElement('div');
    posologieCol.classList.add('col');
    var posologieInput = document.createElement('input');
    posologieInput.type = 'text';
    posologieInput.classList.add('form-control');
    posologieInput.placeholder = 'Posologie';
    posologieInput.name = 'medications[posologie]';
    posologieCol.appendChild(posologieInput);
    row.appendChild(posologieCol);

    // Create nombre d'unités field
    var nbruniteCol = document.createElement('div');
    nbruniteCol.classList.add('col');
    var nbruniteInput = document.createElement('input');
    nbruniteInput.type = 'text';
    nbruniteInput.classList.add('form-control');
    nbruniteInput.placeholder = "Nombre d'unités";
    nbruniteInput.name = 'medications[nbrunite]';
    nbruniteCol.appendChild(nbruniteInput);
    row.appendChild(nbruniteCol);

    // Create QSP field
    var qspCol = document.createElement('div');
    qspCol.classList.add('col');
    var qspInput = document.createElement('input');
    qspInput.type = 'text';
    qspInput.classList.add('form-control');
    qspInput.placeholder = 'QSP';
    qspInput.name = 'medications[qsp]';
    qspCol.appendChild(qspInput);
    row.appendChild(qspCol);

    // Append the new medication row to the container
    medicationsContainer.appendChild(row);
}

</script>


</body>

</html>