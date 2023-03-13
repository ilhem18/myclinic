<?php 
session_start();
require 'config.php';
if (isset($_SESSION['idUser']) != "") {
  header("Location: index.php");
}
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  $result = mysqli_query($con, "SELECT * FROM utilisateur WHERE username = '" . $username ."' AND password = '".md5($password)."' ");
  if (!empty($result)) {
    if ($row = mysqli_fetch_array($result)) {
      $_SESSION['idUser'] = $row['idUser'];
      $_SESSION['nom_prenom'] = $row['nom_prenom'];
      $_SESSION['username'] = $row['username'];
      header("Location: index.php");
    }
  } else {
    $message_erreur = "Nom d'utilisateur ou mot de passe érronés!";
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/logo_myclinic (1).png">
    <title>Connexion</title>
    <style>
        *{
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
body{
  color: #fff;
  font-family: 'Muli', sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  overflow: hidden;
}
.container{
  background-color: #1B6CA8;
  padding: 20px 40px;
  border-radius: 5px;
}
.container h1{
  text-align: center;
  margin-bottom: 30px;
}
.container a {
  text-decoration: none;
  color: rgb(83, 144, 201);
}
.btn{
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
.btn:focus{
  outline: 0;
}
.btn:active{
  transform: scale(0.98);
}
.text{
  margin-top: 30px;
}
.form-control{
  position: relative;
  margin: 20px 0 40px;
  width: 300px;
}
.form-control input{
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
.form-control input:valid{
  outline: 0;
  border-bottom-color: rgb(6, 9, 189);
}
.form-control label{
  position: absolute;
  top: 15px;
  left: 0;
}
.form-control label span{
  display: inline-block;
  font-size: 18px;
  min-width: 5px;
  transition: 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.form-control input:focus + label span,
.form-control input:valid + label span{
  color: rgb(83, 144, 201);
  transform: translateY(-30px);
}
    </style>
</head>
<body>
    <div class="container">
        <h1>CONNEXION</h1>
        <form action="" method="post">
          <div class="form-control">
            <input type="text" name="username" id="username" value="" required>
            <label>Nom d'utilisateur</label>
          </div>
          <div class="form-control">
            <input type="password" name="password" id="password" value="" required>
            <label>Mot de passe</label>
          </div>
          <button name="login" class="btn">Se connecter</button>
          <p class="text">Vous n'avez pas encore un compte? <a href="register.php">Inscrivez-vous</a></p>
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