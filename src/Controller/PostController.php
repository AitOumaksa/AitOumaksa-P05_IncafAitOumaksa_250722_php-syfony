<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;





class PostController extends MainController
{
    public function getPosts()
    {
        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $id = self::getUrlParams('user_id');
        $posts = $postModel->listData();
        foreach ($posts as $post) {
            echo  $post['title'] . '</br>';
        }

        return $posts;
    }
}
