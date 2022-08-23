<?php

namespace App\Controller;

use App\Routes\HttpRequest;
use  App\Controller\setupSmtp\SmtpSend;

class ContactMailController extends MainController
{



    public function sendMessage($requestForPost)
    {

        $data = $requestForPost->ValueForm();
        //var_dump($data);

        try {
            $name = $this->verifyInputName($data['name']);
            $email = $this->verifyInputEmail($data['email']);
            $message = $this->verifyInputMessage($data['message']);

            if ($email && $name && $message) {

                $smtpSend = new SmtpSend();
                $sendMessage = $smtpSend->smtpSend($data);

                header("Content-Type : application/json");
                if ($sendMessage == true) {

                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
