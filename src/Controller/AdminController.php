<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;
use App\Routes\HttpRequest;
use App\Routes\Request;

class AdminController extends MainController
{


    /**
     * get all posts from admin 
     * @return View or is not allowed
     */

    public function getPostsAdmin()
    {
        $is_admin = $this->session->getUserVar('is_admin');
        if ($is_admin === 'Admin') {
            $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
            $posts = $postModel->getAllPost();
            return $this->view('admin_interface.twig', compact('posts'));
        } else {
            return $this->view('autorisation.twig');
            throw new \Exception('you can\'t access to the interface admin.');
        }
    }
}
