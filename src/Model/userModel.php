<?php

namespace App\Model;



class userModel extends MainModel
{

    public function signUpUser($user_name, $email, $password)
    {
        $date = date("Y-m-d H:i:s");
        $is_admin = 0;
        $col_table = ['user_name', 'mail', 'password', 'is_admin', 'createdAt', 'updatedAt'];
        $values = array($user_name, $email, $password, $is_admin,  $date, $date);
        //var_dump($values);
        return $this->insertData($col_table, $values);
    }

    public function getMailUser($email)
    {

        $col_table = ['user.mail'];
        return $this->selectOneData($col_table, null, 'user.mail', $email);
    }

    public function loginUser()
    {
    }
}
