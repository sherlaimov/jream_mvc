<?php
require('config/config.php');

//require_once(LIBS . 'Form/validate.php');

function __autoload($class){
    require_once LIBS . strtolower($class). '.php';
}

//require('libs/routing.php');
//require('libs/controller.php');
//require('libs/model.php');
//require('libs/view.php');
//require('libs/database.php');
//require_once('libs/session.php');
//require_once('libs/hash.php');

$route = new Routing();
//$route->setControllerPath('c');
$route->init();