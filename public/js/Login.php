<?php
if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email'])) {
    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    if($password == sha1(1234)) {
        echo "yes";
    } else {
        echo "no";
    }
} else {
    echo "no";
}