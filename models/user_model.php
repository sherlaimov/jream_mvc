<?php

class User_Model extends Model
{

    function __construct()
    {
        parent::__construct();


    }

    /**
     * @return mixed
     */
    public function userList()
    {
        return $this->db->select('SELECT user_id, login, role FROM users');

//        $stm = $this->db->prepare('SELECT id, login, role FROM users');
//        $stm->execute();
//        return $stm->fetchAll();

    }

    public function singleUserList($user_id)
    {

        $STH = $this->db->prepare('SELECT user_id, login, role FROM
                                    users WHERE user_id = :user_id');
        $STH->execute(array(':user_id' => $user_id));
        var_dump($STH);
        return $STH->fetch();


    }


    public function insertUser($data)
    {

        $this->db->insert('users', array(
                'login' => $data['login'],
                'password' => Hash::create_hash('md5', $data['password'], HASH_KEY),
                'role' => $data['role'],
        ));

//        $stm = $this->db->prepare("INSERT INTO users
//          (login, password, role)
//          VALUES (:username, :password, :role)
//          ");
//        $stm->execute(array(
//            ':login' => $data['login'],
//            ':password' => Hash::create_hash('md5', $data['password'], HASH_KEY),
//            ':role' => $data['role'],
//        ));


    }

    public function editUser($data)
    {
        //echo $data['role']; die;
        $postData = array(
            'login' => $data['login'],
            'password' => Hash::create_hash('md5', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']
        );

        $this->db->update('users', $postData, "`id` = {$data['user_id']}");

//        $stm = $this->db->prepare("UPDATE users
//            SET login = :login,
//             password = :password,
//              role = :role
//            WHERE id = :id");
//
//        //var_dump($stm);die;
//        $stm->execute(array(
//            ':id'       => $data['id'],
//            ':login' => $data['login'],
//            ':password' => $data['password'],
//            ':role'     => $data['role']
//        ));
    }

    public function deleteUser($user_id)
    {
        $STH = $this->db->prepare('SELECT role FROM users where user_id = :user_id');
        $STH->execute(array(':user_id' => $user_id ));
        $result = $STH->fetch();
        //echo $result['role']; die;
        if($result['role'] == 'owner')
            return false;
        $this->db->delete('users', "user_id = '$user_id'");
//        $STH = $this->db->prepare('DELETE FROM users where id = :id');
//        $STH->execute(array(':id' => $id ));
    }


}
