<?php
require_once("../../App/Class/Database.php");
$db = new Database("localhost", "codelab", "root", "root");
$ip = $_SERVER['REMOTE_ADDR'];
$getLike = $db->countRow("SELECT * FROM likes WHERE ip = ?", [$ip], false);

if($getLike == 0) {

    $db->insert("INSERT INTO likes(ip, idPost) VALUES(?, ?)", [$ip, $_POST['idPost']]);
    echo "inserted";

} else {
    $db->delete("DELETE FROM likes WHERE ip = ?", [$ip]);
    echo "already";
}
