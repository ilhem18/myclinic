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
    <!--bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <script src="https://kit.fontawesome.com/8fc5187318.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>My Clinic</title>
</head>
<body>
    <div class="box">
        <input id="search" type="text" onkeyup="myFunction()" placeholder="Rechercher un patient">
        <a id="searchBtn" href="#"><i class="fas fa-search"></i></a>
    </div>
    <div class="content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutpatientpmodal"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Ajouter un patient</button>
        <a href="index.php?logout='1'"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Se déconnecter</a>
    </div>


    <!--current date-->
      <div class="date">
        <?php 
          $jour = getdate();
          $semaine = array(" Dimanche"," Lundi"," Mardi"," Mercredi"," Jeudi"," vendredi"," samedi");
          $mois =array(1=>" janvier "," février "," mars "," avril "," mai "," juin "," juillet "," août "," septembre "," octobre "," novembre "," décembre ");
        echo $semaine[date('w')] ," ",date('j')," ", $mois[date('n')], date('Y'),"";
         ?>
    </div>
    <!--Tableau des patient-->
    <div class="title">
        <h1>Liste des patients</h1>
    </div>
    <?php 
    require 'config.php';
    $resultat = mysqli_query($con, "SELECT * FROM patient");
    ?>
<div class="table">
  <table id="data-table" class="table table-hover">
  <thead>
    <tr>
      <th></th>
      <th scope="col">Nom</th>
      <th scope="col">Age</th>
      <th scope="col">Dernière consultation</th>    
      <th scope="col" colspan="3"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultat as $row) { ?>
    <tr>
      <td><?php echo $row['id_patient']; ?></td>
      <td scope="row"><?php echo $row['name'] ?></td>
      <td><?php echo $row['age'] ?></td>
      <td></td>
      <td>
        <a href="infosPatient.php?id_patient=<?php echo $row['id_patient']; ?>" class="btn btn-primary"><i class="fa-solid fa-file" title="afficher"></i></a>
      </td>
      <td>
        <button class="btn btn-primary editbtn"><i class="fa-solid fa-file-pen" title="modifier"></i></button>
      </td>
      <td>
        <a class="btn btn-primary" href="crudPatient.php?delete=<?php echo $row['id_patient']; ?>" ><i class="fa-solid fa-trash" title="supprimer"></i></a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>



<!--AJOUTER PATIENT MODAL-->
<div class="modal fade" id="ajoutpatientpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau Patinet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="crudPatient.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      <input type="hidden" class="form-control" name="id_patient" id="id_patient">
        <div class="form-group">
          <label>Nom</label>
           <input type="text" class="form-control" name="name" >
        </div>
        <div class="form-group">
          <label>Age</label>
           <input type="date" class="form-control" name="age">
        </div>
        <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="sexe" value="homme" checked> homme
            <br>
            <input class="form-check-input" type="radio" name="sexe" value="femme" checked> femme
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="ajout_patient" class="btn btn-primary">Enregistrer</button>
      </div>
    </form> 
    </div>
  </div>
</div>


<!-- Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Patinet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="crudPatient.php" method="POST">
      <div class="modal-body">

      <input type="hidden" name="update_id" id="update_id">

      
        <div class="form-group">
          <label>Nom</label>
           <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
          <label>Age</label>
           <input type="date" class="form-control" name="age" id="age">
        </div>
        <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="sexe" id="sexe" checked> homme
            <br>
            <input class="form-check-input" type="radio" name="sexe" id="sexe" checked> femme
            </div>
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





       







<!--search js-->
<script>
 function myFunction() {
  // Declare variables
  var input, filter, table, tr, te, th, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("data-table");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    th = tr[i].getElementsByTagName("td")[0];
    if (th) {
      txtValue = th.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<!--search js ends-->

<!--edit-->
<script>
  $(document).ready(function() {
    $('.editbtn').on('click', function(){
 
      $('#editModal').modal('show');

      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();
      console.log(data);

      $('#update_id').val(data[0]);
      $('#name').val(data[1]);
      $('#age').val(data[2]);
      $('#sexe').val(data[3]);
    });
  });
</script>
</body>
</html>