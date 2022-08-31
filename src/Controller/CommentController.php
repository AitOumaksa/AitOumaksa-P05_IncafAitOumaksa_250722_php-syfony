<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\commentModel;
use App\Model\PostModel;
use App\Routes\HttpRequest;

class CommentController extends MainController
{

    /**
     * get comment attached to a post 
     * @param Integer $post_id
     * @return Array $comment 
     */
    public function getComments($post_id)
    {

        $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
        $comments = $commentModel->getComments($post_id);
        return $comments;
    }

    /**
     * get one comment 
     * @param Integer $comment_id
     * @return Array $comment 
     */
    public function getOneComment($comment_id)
    {

        $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
        $comment = $commentModel->getOneComment($comment_id);
        return $comment;
    }

    /**
     * add comment 
     * @param Integer $post_id
     * @param Object $requestForPost
     * @return Array $comment 
     */

    public function addComment($requestForPost, $post_id)
    {
        $id_user = 48;
        $data = $requestForPost->ValueForm();

        try {
            $content = $this->verifyInputMessage($data['comment_content']);
            if ($content) {
                $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
                $setComment = $commentModel->addComment($post_id, $data['comment_content'], $id_user);
                if ($setComment != 'nok') {
                    echo json_encode(array(
                        'success' => true
                    ));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * Update comment  
     * @param Integer $id_comment
     * @param Object $requestForPost
     * @return BOOL  or error  
     */

    public function updateComment($requestForPost, $id_comment)
    {
        $data = $requestForPost->ValueForm();

        try {
            $content = $this->verifyInputMessage($data['comment_content']);
            if ($content) {
                $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
                $setComment = $commentModel->updateComment($id_comment, $data['comment_content']);
                if ($setComment != 'nok') {
                    echo json_encode(array(
                        'success' => true
                    ));
                }
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }


    /**
     * Delete comment  
     * @param Integer $id
     * @return BOOL  or error  
     */

    public function deleteComment($id)
    {
        try {

            $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
            $deleteComment = $commentModel->deleteComment($id);
            if ($deleteComment == true) {

                echo json_encode(array("success" => true));
            }
        } catch (\Exception $e) {

            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
