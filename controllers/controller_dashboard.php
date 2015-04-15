<?php

class Controller_Dashboard extends Controller{

    function __construct() {
        parent::__construct();
        $this->model = $this->load_model('dashboard');

        $this->handleLogin();

        $this->view->js = array('dashboard/js/default.js');
        
        
    }
    
    function index(){
        $this->view->render('dashboard/index');
    }
    
    function logout(){
        Session::destroy();
        header('location: ../login');
        exit;
    }

    function xhrInsert(){
        $this->model->xhrInsert();
    }

    function xhrGetListings(){
        $this->model->xhrGetListings();
    }
    
    function xhrDeleteListing(){
        $this->model->xhrDeleteListing();
    }

}