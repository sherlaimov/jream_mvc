<?php




define('URL', 'http://mvc.jream/');
// The sitewide hashkey, do not change this because it's used for passwords!
define('HASH_KEY', 'secret');
define('LIBS', 'libs/');

//DATABASE CONSTANTS
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'root');
define('DB_PASS', 'secret');





defined('PUBLIC_URL')
    || define('PUBLIC_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ?
        'https' : 'http') . "://" . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] != 80 ?
        ":{$_SERVER['SERVER_PORT']}" : '') . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

//echo $dir;
//echo dirname(__FILE__) . '<br/>';
//echo $_SERVER['DOCUMENT_ROOT'] . '<br/>';
//var_dump($dir); die();