<?php

class Controller_Login extends Controller{
    
    
    
    function __construct() {
        parent::__construct();

        $this->model = $this->load_model('login');
    }
    
    function index(){

        echo Hash::create_hash('md5', 'secret', HASH_KEY);

        $this->view->render('login/index');
    }
    
    function runLogin(){
        //echo 'runLogin';
        $this->model->runLogin();
    }

}