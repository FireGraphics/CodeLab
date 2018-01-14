<?php
class Post {
    public function getExtrait() {
        if(strlen($this->content) > 120) {
            return substr($this->content, 0, 120) . "...";
        } else {
            return $this->content;
        }
    }

    public function getTitle($max = 58) {
        if(strlen($this->title) > $max) {
            return substr($this->title, 0, $max) . "...";
        } else {
            return $this->title;
        }
    }

    public function getDatePost($date, $hour) {
        $nowDay = Date("d");
        $nowHour = Date("H");
        $nowMinute = Date("i");
        if($nowDay - $date == 0) {
            return "Maintenant";
        } else {
            return $nowDay - $date . " jours";
        }
    }

}