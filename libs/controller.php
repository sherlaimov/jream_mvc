<?php

class Controller {
    
    function __construct() {
        Session::init();
        $this->view = new View();
        //print_r($_SESSION);
    }
    
    public function load_model($name){
        $file = 'models/' . $name . '_model.php';
        
        if(file_exists($file)){
            require $file;
            $modelName = $name. '_Model';
            return $this->model = new $modelName();
        }
    }

    public function handleLogin(){
        $logged = Session::get('loggedIn');
        if($logged == false) {
            Session::destroy();
            if(isset($_SERVER['HTTP_REFERER'])){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else{

                header('Location: ' . URL . 'login');
                exit;
            }

        }
    }
    
 

}