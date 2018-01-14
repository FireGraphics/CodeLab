<?php
session_start();
$connect = new Connections();
if(isset($_SESSION['isConnect']) && $connect->isConnect($_SESSION['isConnect'])) {
    $isConnect = true;
} else {
    $isConnect = false;
}
include_once("connect-modal.php");
include_once("register-modal.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodeLab</title>
     <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/CodeLab/public/css/main.css">
</head>
<body>
        <nav class="blue" style="padding-left: 20px;padding-right: 20px;">
            <div class="nav-wrapper">
            <a href="#" class="brand-logo">CodeLab</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="#modal1" class="modal-trigger">Se connecter</a></li>
                <li class="waves-effect waves-light btn white" style="margin-top: 13px;margin-left: 10px;"><a style="color: #008FF7;width: 100%;" href="#modal2" class="modal-trigger">S'inscrire</a></li>
            </ul>
            </div>
        </nav>
        <div class="menu">
            <div class="right" style="float: right;">
                <a <?php if(!$isConnect) { echo 'onclick="Materialize.toast(\'Vous devez être connecté pour poster une annonce !\', 4000)"';  }  ?>class="waves-effect waves-light blue btn"><i class="material-icons right">send</i>Déposer un article</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?= $content  ?>
            </div>
        </div>
        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="/CodeLab/public/js/main.js"></script>
</body>
</html>