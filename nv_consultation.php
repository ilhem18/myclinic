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

        .wrapper .main_content {
            width: 100%;
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
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main_content">
            <div class="header">
                <h2>Général</h2>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Motif">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Diagnostique">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Poids">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Taille">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Température">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Fréquence cardiaque">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Pression artérielle">
                        </div>
                    </div>
                </form>
            </div>
            <div class="dossier_medical">
                <button type="button" data-toggle="modal" data-target="#Ordonnancemodal">Ordonnance</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Bilanpmodal">Bilan</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ARTtravailmodal">Arrêt de travail</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#certifmedicalmodal">Certificat médical</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orientationmodal">Lettre d'orientation</button>
            </div>
            <div class="top-right">
                <button><a href="">Sauvegarder</a></button>
                <button><a href="infosPatient.php">Annuler</a></button>
            </div>
        </div>
    </div>





    <!--BEGIN MODALS-->
    <!--Ordonnance-->
    <div class="modal" id="Ordonnancemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ordonnance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="manipulation-ordonnance">
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Aperçu</button>
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-print"></i>Imprimer</button>
                    </div>
                    <br>
                    <div class="infopatient">
                        <form>
                            <div class="form-group row">
                                <label for="staticPatient" class="col-sm-2 col-form-label">Patient</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Readonly input here…" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col">
                                            <label for="inputAge" class="col-sm-2 col-form-label">Age</label>
                                            <input type="text" class="form-control" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="inputAge" class="col-sm-2 col-form-label">Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="table-medicament">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Médicament</th>
                                    <th scope="col">Posologie</th>
                                    <th scope="col">Nbr d'unité</th>
                                    <th scope="col">Qsp</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><input type="text" class="form-control"></th>
                                    <th><input type="text" class="form-control"></th>
                                    <th><input type="text" class="form-control"></th>
                                    <th><input type="text" class="form-control"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                        <!--<form action="">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </form>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Sauvegarder</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>









    <!--END MODALS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>