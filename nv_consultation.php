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
                <form>
                <?php 
                         require 'config.php';
                         if (isset($_GET['id_patient'])) {
                        
                        $id = $_GET['id_patient'];
                        $show = mysqli_query($con, "SELECT * FROM patient WHERE id_patient='$id'"); 

                        foreach ($show as $row) { ?>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" value="<?php echo $row['name'] ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" value ="<?php  
                                                                            $dob= $row['age'];
                                                                            function getAge($dob){
                                                                            $bday= new DateTime($dob);
                                                                            $today = new DateTime(date('d.m.y'));
                                                                            $diff = $today->diff($bday);
                                                                            return $diff->y; } ?>
                            <?php echo getAge($row['age']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                         <input type="text" class="form-control" value="<?php date_default_timezone_set('Africa/Algiers');
                             echo date("d-m-y H:i:s");?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Motif">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Diagnostique">
                        </div>
                    </div>
                </form>
                <?php }} ?>
            </div>
            <div class="dossier_medical">
            <div class="ordonnance">
                <h4>Ordonnance</h4>
                <!--<table class="table" id="tbl">
                <thead>
                <th scope="col">Médicament</th>
                <th scope="col">Posologie</th>
                <th scope="col">Nbr d'unité</th>
                <th scope="col">Qsp</th>
                <th scope="col" colspan="2"></th>
                </thead>
                <tbody>
                </tbody>
                </table>-->
            <form method="POST" class="for">
            <div id="main">
                <div class="form-row">
                <div class="col">
                <input type="text" class="form-control" placeholder="Médicament" name="medicament">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Posologie" name="posologie">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Nombre d'unités" name="nbrunite">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="QSP" name="qsp">
                </div>
                </div>
                <div id="ss">
                <a href="javascript:data()" type="submit" class="btn btn-primary add">+</a>
                </div>
            </div>
            </form>
            </div>
            </div>
            <div class="top-right">
                <button><a href="">Sauvegarder</a></button>
            </div>
        </div>
    </div>

    <div id="subinputs" style="display: none">
                <div class="form-row">
                <div class="col">
                <input type="text" class="form-control" placeholder="Médicament" name="medicament">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Posologie" name="posologie">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Nombre d'unités" name="nbrunite">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="QSP" name="qsp">
                </div>
                </div>
            </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    var a=1;
    function data(){
        a++;
        var input = document.createElement("div");
        var dtd = '<div>Delete</div>';
        input.innerHTML = document.getElementById('subinputs').innerHTML + dtd;
        document.getElementById("main").append(input);
    }

</script>


</body>

</html>