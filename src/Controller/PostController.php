<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;





class PostController extends MainController
{

    public function getPosts()
    {
        $col_replace = [
            '*',
            'post.id',
            'post.title',
            'post.chapo',
            'post.createdAt' => 'datePublication',
            'post.updatedAt' => 'updatePublication',

        ];
        $col_join = ['user' => 'user.id=post.id_user'];
        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $posts = $postModel->selectAllPosts($col_join, $col_replace);
        return $this->view('posts.twig', compact('posts'));
    }
    public function getOnePost()
    {
        return $this->view('onePost.twig');
    }
}
