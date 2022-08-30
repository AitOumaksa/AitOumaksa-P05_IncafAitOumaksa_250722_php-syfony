<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;
use App\Routes\HttpRequest;
use App\Routes\Request;

class AdminController extends MainController
{

    public function getPostsAdmin()
    {

        $col_table = [
            'post.id',
            'post.title',
            'post.chapo',
            'post.autor',
            'post.createdAt' => 'datePublication',
            'post.updatedAt' => 'updatePublication',

        ];
        $join = ['user' => 'user.id=post.id_user'];


        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $posts = $postModel->selectData($col_table, $join, null, null);
        return $this->view('admin_interface.twig', compact('posts'));
    }
}
