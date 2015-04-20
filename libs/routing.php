<?php

class Routing {

    private  $_url = array();
    private $_controller = null;
    private $_controllerPath = 'controllers/';
    private $_modelPath = 'models/';
    private $_errorFile = 'error.php';
    private $_defaultController = 'index.php';



    public function init(){
        //Sets the protected $_url
        $this->_getUrl();

        //Load the default controller if no url is set
        if(empty($this->_url[0])){
            $this->_loadDefaultController();

            return false; //to prevent the code below form executing
        }

        $this->_loadExistingController();
        $this->_callControllerMethod();
    }

    public function setControllerPath($path){
        $this->_controllerPath = trim($path, '/') . '/';
    }

    public function setModelPath($path){
        $this->_modelPath = trim($path, '/') . '/';
    }

    public function setErrorFile($path){
        $this->_errorFile = trim($path, '/');
    }


    private function _getUrl(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/'); //trimming off all the /// on the right
        $url = explode('/', $url);
        $this->_url = $url;
    }

    private function _loadDefaultController(){

        require_once $this->_controllerPath . $this->_defaultController;
        $this->_controller = new Controller_Index();
        $this->_controller->index();
    }

    private function _loadExistingController(){
        $controller_name = 'controller_' . $this->_url[0];
        $controller_file = $controller_name . '.php';
        //check if file exists
        $file = $this->_controllerPath . $controller_file;
        if(file_exists($file)){
            require $file;
            $this->_controller = new $controller_name();

        } else {

            $this->_error();
            return false;
        }
    }

    private function _callControllerMethod()
    {
        // calling CONTROLLER METHODS, 2 index = argument name


        $length = count($this->_url);

        //make sure the method we are calling exists
        if ($length > 1) {
            if ( ! method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }

        //Determine what to load
        switch ($length) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);

                break;
            case 4:
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);

                break;
            case 3:
                $this->_controller->{$this->_url[1]}($this->_url[2]);

                break;
            case 2:
                $this->_controller->{$this->_url[1]}();
                break;
            default:
                $this->_controller->index();
                //die('Please check your routing');
                break;
        }
    }

    
    function _error(){
        require $this->_controllerPath . $this->_errorFile;
            $this->_controller = new Controller_Error();
            $this->_controller->error_message('Controller does not exist');
            $this->_controller->index();
            return false;
    }

}
