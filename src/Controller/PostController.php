<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\PostModel;
use App\Model\commentModel;
use App\Routes\HttpRequest;




class PostController extends MainController
{

    /**
     * get all posts and diplay 
     * @return Array $posts and a view to display posts page 
     */

    public function getPosts()
    {
        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $posts = $postModel->getAllPost();
        return $this->view('posts.twig', compact('posts'));
    }

    /**
     * get one posts with his comments and display  
     * @return Array $posts, $comment and a view to display onePost page 
     */

    public function getOnePost($post_id)
    {

        $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
        $commentModel = new CommentController();
        $comments = $commentModel->getComments($post_id);
        $one_post = $postModel->getOnePost($post_id);
        return $this->view('onePost.twig', compact('one_post', 'comments'));
    }


    /**
     * check the input and add post 
     * @param Object $requestForPost
     * @return True or error  
     */

    public function addPost($requestForPost)
    {

        $id_user = 48;
        $data = $requestForPost->ValueForm();

        try {
            $title = $this->verifyInputMessage($data['title']);
            $chapo = $this->verifyInputMessage($data['chapo']);
            $content = $this->verifyInputMessage($data['content']);
            $autor = $this->verifyInputName($data['autor']);



            if ($title && $chapo  && $autor && $content) {
                $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
                $setPost = $postModel->setPost($id_user, $data['title'], $data['chapo'], $data['autor'], $data['content']);
                if ($setPost != 'nok') {

                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * check the input and add updated a post 
     * @param Object $requestForPost
     * @param Integer $id
     * @return True or error  
     */

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
                $updatePost = $postModel->updatePost($id, $data['title'], $data['chapo'], $data['content'], $data['autor']);

                if ($updatePost != 'nok') {

                    echo json_encode(array("success" => true));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * Delete post 
     * @param Integer $id
     * @return False  or error  
     */

    public function deletePost($id)
    {
        try {

            $postModel = new PostModel(new PDOModel(ConnectDB::getPDO()));
            $deletePost = $postModel->deletePost($id);
            if ($deletePost == true) {

                echo json_encode(array("success" => true));
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
