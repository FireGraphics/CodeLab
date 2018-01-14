<?php
class Autoloader {
    public static function autoload() {
        spl_autoload_register(function ($class) {
           require_once("Class/" . $class . ".php");
        });
    }

}