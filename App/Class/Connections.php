<?php
class Connections {

    public function isConnect($session) {
        if(isset($session) && $session == true) {
            return true;
        } else {
            return false;
        }
    }

 }
?>