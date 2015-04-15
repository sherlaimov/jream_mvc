<?php

class Session {

    
    public static function init(){
       // echo debug_print_backtrace(); die;
        session_start();
        //echo '3 ';
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key){
        if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    }
    
    public static function destroy(){
        //unset($_SESSION);
        session_destroy();
    }

}