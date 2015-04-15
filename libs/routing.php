<?php

class Routing {

    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/'); //trimming off all the /// on the right
        $url = explode('/', $url);
        
        $controller_name = 'controller_' . $url[0];
        $controller_file = $controller_name . '.php';
        if(empty($url[0])){
            require 'controllers/controller_index.php';
            $controller = new Controller_Index();
            $controller->index();
            return false; //to prevent the code below form executing
        }
        //check if file exists
        $file = 'controllers/' . $controller_file;
        if(file_exists($file)){
            require $file;
        } else {
          
            $this->error();
            return false;
        }
        

        //0 index array = class Name, but what if it doens't exist?!

        $controller = new $controller_name;
        //$controller->load_model($url[0]);
        


    // calling CONTROLLER METHODS, 2 index = argument name
        if (isset($url[2])) {
            if (method_exists($controller, $url[1])){
                $controller->$url[1]($url[2]);
            } else {
                $this->error();
            }     
            
        } else {

            //1 index array = method name;
            if (isset($url[1])) {
               if (method_exists($controller, $url[1])){
                   $controller->$url[1](); // call to a method
                } else {
                    $this->error();
                }
            } else {
              $controller->index();  
            }
        }
        
    }
    
    function error(){
        require 'controllers/controller_error.php';
            $controller = new Controller_Error();
            $controller->error_message('Controller does not exist');
            $controller->index();
            return false;
    }

}
