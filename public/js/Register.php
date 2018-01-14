<?php
require_once("../../App/Class/Database.php");
$db = new Database("localhost", "codelab", "root", "root");
if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $password = sha1($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    
    if($db->isEmail($email)) {
        if($db->emailExist($email)) {
            echo "L'addresse e-mail que vous avez entré est déjà utilisée !";
        } else {
            $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
            if(preg_match($pattern, $username)) {
                echo "Le nom d'utilisateur ne peux pas contenir des caractères spéciaux !";
            } else {
                if($db->usernameExist($username)) {
                    echo "Le nom d'utilisateur que vous avez entré est déjà utilisée !";
                } else {
                    echo "success";
                }
            }
        }
    } else {
        echo "L'addresse e-mail que vous avez entré n'est pas valide !";
    }

} else {
    echo "Veuillez remplir tous les champs !";
}