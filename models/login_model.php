<?php

class Login_Model extends Model {

    public function __construct() {
       parent::__construct();

    }
    
    public function runLogin(){
 


        $stm = $this->db->prepare("SELECT user_id, role from users WHERE login = :login
            AND password = :password");
        
        $stm->execute(array(
           ':login' => $_POST['login'],
           ':password' => Hash::create_hash('md5', $_POST['password'], HASH_KEY)
        ));

        //var_dump($stm); die();

        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $data = $stm->fetch();

        //var_dump($stm); die();
        $count = $stm->rowCount();
        //var_dump($count); die();
        if($count > 0) {
            //login
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            Session::set('user_id', $data['user_id']);
            header('location: ../dashboard');
        } else {
            //show an error
           header('location: ../login');
        }
    }
   

}