<?php
require_once("App/Autoloader.php");
Autoloader::autoload();

if(isset($_GET['p'])) {
    $p = htmlspecialchars($_GET['p']);
} else {
    $p = "home";
}

// initialization des objets
$db = new Database("localhost", "codelab", "root", "root");

ob_start();
if ($p == "home") {
    require_once("pages/home.php");
}
$content = ob_get_clean();
require_once("pages/template/default.php");
