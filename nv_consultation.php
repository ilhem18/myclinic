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
            background: #f3f5f9;
        }
        .wrapper{
        display: flex;
        position: relative;
}
        .wrapper .sidebar{
    position: fixed;
    width: 200px;
    height: 100%;
    background: #93bfd4;
    padding: 30px 0;
}
.wrapper .sidebar h2{
    color: #fff;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 100px;
}
.wrapper .sidebar ul li{
    padding: 15px;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    border-top: 1px solid rgba(225,255,255,0.05);
}
.wrapper .sidebar ul li a{
    color: #030611ce;
    font-size: 18px;
    display: block;
}
.wrapper .sidebar ul li:hover{
    background: rgb(56, 79, 133);
}
.wrapper .sidebar ul li:hover a{
    color: #fff;
    /*color: rgb(3, 3, 3);*/
    text-decoration: none;
}
        .wrapper .main_content {
            width: 100%;
    margin-left: 200px;
        }

        .wrapper .main_content .header {
            width: 100%;
            height: 350px;
            margin-top: 10px;
            padding: 30px;
            background: #fff;
            color: #717171;
            border-bottom: 2px solid #e0e4e8;
        }

        .wrapper .top-right button {
            margin-top: 50px;
            border: none;
            width: 270px;
            font-size: 20px;
            background: #1f97cf;
            padding: 20px 50px;
            margin-left: 50px;
            margin-bottom: 20px;
            border-radius: 20px;
        }

        .wrapper .top-right button a {
            color: #f3f5f9;
        }

        .wrapper .top-right button a:hover {
            text-decoration: none;
        }

        .wrapper .dossier_medical {
            padding: 50px;
            width: 100%;
            background: #fff;
            text-align: center;
            justify-content: center;
            border-bottom: 5px solid #e0e4e8;
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
        .flex{
            display: flex;
            gap: 1.5rem;
        }
        .delete{
            text-decoration: none;
            display: inline-block;
            background: #f44336;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            width: 30px;
            height: 30px;
            margin-left: auto;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
    </style>
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
    <label for="medications">Médicaments</label>
    <div id="medications">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Médicament" name="medications[0][med_name]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Posologie" name="medications[0][posologie]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Nombre d'unités" name="medications[0][nbrunite]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="QSP" name="medications[0][qsp]">
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mt-2" onclick="addMedication()">Ajouter un médicament</button>
</div>
            </div>
            </div>
            <div class="top-right">
                <button name="add_btn">Sauvegarder</a></button>
            </div>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
  let medicationCount = 1;

function addMedication() {
    medicationCount++;
    let medication = `
        <div class="row mt-2">
            <div class="col">
                <input type="text" class="form-control" placeholder="Médicament" name="medications[${medicationCount}][med_name]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Posologie" name="medications[${medicationCount}][posologie]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Nombre d'unités" name="medications[${medicationCount}][nbrunite]">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="QSP" name="medications[${medicationCount}][qsp]">
            </div>
        </div>
    `;
    document.getElementById('medications').insertAdjacentHTML('beforeend', medication);
}

</script>


</body>

</html>