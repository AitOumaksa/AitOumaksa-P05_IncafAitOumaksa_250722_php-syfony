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
        $posts = $postModel->selectData($col_table, null, null, null);
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
        //var_dump($one_post);
        return $this->view('onePost.twig', compact('one_post', 'comments'));
    }


    public function addPost($requestForPost, $param)
    {

        $token = $this->verifAuth();
        $data = $requestForPost->ValueForm();


        try {
            $title = $this->verifyInputMessage($data['title']);
            $chapo = $this->verifyInputMessage($data['chapo']);
            $content = $this->verifyInputMessage($data['content']);
            $autor = $this->verifyInputName($data['autor']);



            if ($title && $chapo  && $autor && $content) {
                $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
                $setPost = $postModel->setPost($token->id, $data['title'], $data['chapo'], $data['autor'], $data['content']);

                if ($setPost == true) {
                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function updatePost($requestForPost, $id)
    {

        $data = $requestForPost->ValueForm();


        try {
            $title = $this->verifyInputMessage($data['title']);
            $chapo = $this->verifyInputMessage($data['chapo']);
            $content = $this->verifyInputMessage($data['content']);
            $autor = $this->verifyInputName($data['autor']);
            if ($title && $chapo  && $autor && $content) {
                $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
                //   var_dump($postModel);
                $updatePost = $postModel->updatePost($id, $data['title'], $data['chapo'], $data['content'], $data['autor']);
                if ($updatePost == true) {

                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }


    public function deletePost($id)
    {
        try {

            $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
            $deletePost = $postModel->deletePost($id);
            /// var_dump($deletePost);
            if ($deletePost == false) {

                echo json_encode(array("success" => false));
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
