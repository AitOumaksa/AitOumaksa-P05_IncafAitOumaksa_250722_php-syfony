<?php

namespace App\Model;

class UserModel extends MainModel
{
    /**
     * Registre a user in the database
     * @param String $user_name
     * @param String $email
     * @param String $password
     * @return Array
     */

    public function signUpUser(string $user_name, string $email, string $password)
    {
        $date = date("Y-m-d H:i:s");
        $is_admin = 0;
        $col_table = ['user_name', 'mail', 'password', 'is_admin', 'createdAt', 'updatedAt'];
        $values = array($user_name, $email, $password, $is_admin,  $date, $date);
        return $this->insertData($col_table, $values);
    }

    /**
     * Get user
     * @param String $email
     */

    public function getUser(string $email)
    {
        $results = $this->selectOneData(null, null, 'mail', $email);
        return new UserTable($results);
    }
}
