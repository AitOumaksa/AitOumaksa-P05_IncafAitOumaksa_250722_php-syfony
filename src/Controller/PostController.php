<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;
use App\Model\commentModel;
use App\Routes\HttpRequest;




class PostController extends MainController
{

    public function getPosts()
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
        return $this->view('posts.twig', compact('posts'));
    }


    public function getOnePost($post_id)
    {
        $col_table = [
            'post.id',
            'post.title',
            'post.chapo',
            'post.content',
            'post.autor',
            'post.createdAt' => 'datePublication',
            'post.updatedAt' => 'updatePublication',

        ];
        $join = ['user' => 'user.id=post.id_user'];
        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $commentModel = new CommentController();
        $comments = $commentModel->getComments($post_id);
        //var_dump($comments);
        $one_post = $postModel->selectData($col_table, $join, 'post.id', $post_id)[0];
        // var_dump($one_post);
        return $this->view('onePost.twig', compact('one_post', 'comments'));
    }
}
