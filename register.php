<?php 
require 'config.php';
if(isset($_SESSION['id']) != ""){
    header("Location: index.php");
}
if(isset($_POST['register_btn'])){
$nom = mysqli_real_escape_string($con, $_POST['nom_prenom']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
if (!preg_match("/^[a-zA-Z]+$/", $nom)) {
    $nom_erreur = "cette case ne doit contenir que des alphabets et de l'espace";
}
if (strlen($password) > 6) {
    $password_erreur = "la taille du mot de passe doit être maximum 5 charactères";
}
if ($password != $cpassword) {
    $cpassword_erreur = "les mots de passes ne correspondent pas!";
} 

if (mysqli_query($con, "INSERT INTO utilisateur(nom_prenom, username, password) VALUES ('" . $nom . "', '" . $username . "', '" . md5($password) . "') ")) {
    header("Location: login.php");
    exit();
} else {
    echo "ERREUR";
}
mysqli_close($con);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <title>Inscription</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            color: #fff;
            font-family: 'Muli', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background-color: #1B6CA8;
            padding: 20px 40px;
            border-radius: 5px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container a {
            text-decoration: none;
            color: rgb(83, 144, 201);
        }

        .btn {
            display: inline-block;
            width: 100%;
            cursor: pointer;
            background-color: rgb(83, 144, 201);
            padding: 15px;
            font-family: inherit;
            font-size: 16px;
            border: 0;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .btn:focus {
            outline: 0;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .text {
            margin-top: 30px;
        }

        .form-control {
            position: relative;
            margin: 20px 0 40px;
            width: 300px;
        }

        .form-control input {
            background-color: transparent;
            border: 0;
            border-bottom: 2px solid #fff;
            display: block;
            width: 100%;
            padding: 15px 0 10px 0;
            font-size: 18px;
            color: #fff;
        }

        .form-control input:focus,
        .form-control input:valid {
            outline: 0;
            border-bottom-color: rgb(6, 9, 189);
        }

        .form-control label {
            position: absolute;
            top: 15px;
            left: 0;
        }

        .form-control label span {
            display: inline-block;
            font-size: 18px;
            min-width: 5px;
            transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .form-control input:focus+label span,
        .form-control input:valid+label span {
            color: rgb(83, 144, 201);
            transform: translateY(-30px);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-control">
                <input type="text" name="nom_prenom" id="nom_prenom" value="" required>
                <label>Nom & prénom</label>
                <span><?php if (isset($nom_erreur)) {
                    echo $nom_erreur;
                } ?></span>
            </div>
            <div class="form-control">
                <input type="text" name="username" id="username" value="" required>
                <label>Nom d'utilisateur</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" id="password_1" value="" required>
                <label>Mot de passe</label>
                <span><?php if (isset($password_erreur)) {
                    echo $password_erreur;
                } ?></span>
            </div>
            <div class="form-control">
                <input type="password" name="cpassword" id="password_2" value="" required>
                <label>Confirmez le mot de passe</label>
                <span><?php if (isset($cpassword_erreur)) {
                    echo $cpassword_erreur;
                } ?></span>
            </div>
            <button type="submit" class="btn" name="register_btn">S'inscrire</button>
            <p class="text">Avez-vous déjà un compte? <a href="login.php">Connectez-vous</a></p>
        </form>
    </div>


    <script>
        const labels = document.querySelectorAll('.form-control label')

        labels.forEach(label => {
            label.innerHTML = label.innerText
                .split('')
                .map((letter, idx) => `<span style="transition-delay:${idx * 50}ms">${letter}</span>`)
                .join('')
        })
    </script>
</body>

</html>