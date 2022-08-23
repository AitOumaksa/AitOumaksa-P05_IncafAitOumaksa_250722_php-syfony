<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;
use App\Routes\HttpRequest;

class AdminController extends MainController
{


    public function adminInterface()
    {
        return $this->view('admin_interface.twig');
    }

    public function addPost($requestForPost)
    {

        $token = $this->verifAuth();
        try {
            $data = $requestForPost->ValueForm();

            $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
            $setPost = $postModel->setPost($token->id, $data['title'], $data['chapo'], $data['autor'], $data['content']);
            $setPostJson = json_encode($setPost);
            var_dump($setPostJson);
            if ($setPostJson == true) {

                echo json_encode(array("success" => true));
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
