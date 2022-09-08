<?php

namespace App\Model;



class userModel extends MainModel
{


    /**
     * Registre a user in the database 
     * @param String $user_name
     * @param String $email
     * @param String $password
     * @return Array 
     */

    public function signUpUser($user_name, $email, $password)
    {
        $date = date("Y-m-d H:i:s");
        $is_admin = 0;
        $col_table = ['user_name', 'mail', 'password', 'is_admin', 'createdAt', 'updatedAt'];
        $values = array($user_name, $email, $password, $is_admin,  $date, $date);
        //var_dump($values);
        return $this->insertData($col_table, $values);
    }

    /**
     * Get user 
     * @param String $email
     */

    public function getUser($email)
    {

        $results = $this->selectOneData(null, null, 'mail', $email);
        return new UserTable($results);
    }
}
