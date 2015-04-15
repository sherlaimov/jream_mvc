<?php

class Controller_Error extends Controller{
    
    public $error;
    
    function __construct() {
        parent::__construct();
        
        
    }
     function index(){
        $this->view->msg = 'This page doesn\'t exist.';
        $this->view->render('error/index');
    }
    
    public function error_message($error){
        $this->error = $error;
        $error_message = "<p class=\"alert alert-danger\">";
        $error_message .= $error . '</p>';
        return $error_message;
        
        }

}