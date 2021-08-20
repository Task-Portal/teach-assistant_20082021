<?php

namespace sys\lib;

class Status{
    public static function get_current_user(){
        $user = "Guest";
        if (isset($_SESSION['user'])){
            $user=$_SESSION['user'];
        }elseif (isset($_COOKIE['user'])){
            $user = $_COOKIE["user"];
        }
        return $user;
    }
}