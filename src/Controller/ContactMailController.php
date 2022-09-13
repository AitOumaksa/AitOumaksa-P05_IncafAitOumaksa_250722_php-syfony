<?php

namespace App\Controller;

use App\Routes\HttpRequest;
use  App\Controller\setupSmtp\SmtpSend;

class ContactMailController extends MainController
{
    /**
     * Receive the form data , check the input .
     * @param Object $requestForPost
     * @return True or error
     */

    public function sendMessage(HttpRequest $requestForPost)
    {
        $data = $requestForPost->valueForm();
        try {
            $this->verifyInputName($data['name']);
            $this->verifyInputEmail($data['email']);
            $this->verifyInputMessage($data['message']);
            $smtpSend = new SmtpSend();
            $sendMessage = $smtpSend->smtpSend($data);

            header("Content-Type : application/json");
            if ($sendMessage) {
                echo json_encode(array("success" => true));
            }
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
