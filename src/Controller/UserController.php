<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\userModel;

class UserController extends MainController
{

    public function signUp($requestForPost)
    {

        $data = $requestForPost->ValueForm();
        //var_dump($data['mail']);


        try {
            $user_name = $this->verifyInputName($data['user_name']);
            $email = $this->verifyInputEmail($data['mail']);
            $password = $this->verifyInputPassword($data['password']);
            if ($user_name && $email  && $password) {

                $userModel = new userModel(new PDOModel(ConnectDB::getPDO()));
                $data['password'] =  password_hash($data['password'], PASSWORD_DEFAULT);
                $user_mail = $userModel->getMailUser($data['mail']);
                $signUpUser = $userModel->signUpUser($data['user_name'], $data['mail'], $data['password']);
                //var_dump($signUpUser);
                if ($user_mail) {
                    throw new \Exception('Email exists.');
                    return false;
                } else if ($signUpUser != 'nok') {

                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
