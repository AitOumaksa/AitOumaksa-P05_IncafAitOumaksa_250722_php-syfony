<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\commentModel;
use App\Model\CommentTable;
use App\Routes\HttpRequest;

class CommentController extends MainController
{
    /**
     * get comment attached to a post
     * @param Integer $post_id
     * @return Object $comment
     */
    public function getComments($post_id)
    {
        $valide = 1;
        $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
        $comments = $commentModel->getComments($post_id, $valide);
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
        try {
            $this->session->isLogged();
            $id_user = $this->session->getUserVar('id');
            $data = $requestForPost->ValueForm();
            $valide = 0;
            $this->verifyInputMessage($data['comment_content']);
            $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
            $setComment = $commentModel->addComment($post_id, $data['comment_content'], $valide, $id_user);
            if ($setComment) {
                echo json_encode(array(
                    'success' => true
                ));
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
        $this->session->isLogged();
        $data = $requestForPost->ValueForm();
        $id_user = $this->getOneComment($id_comment)->getIdUser();
        $user = $this->session->getUserVar('id');
        $valide = 0;
        try {
            $this->verifyInputMessage($data['comment_content']);
            if ($user === $id_user) {
                $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
                $setComment = $commentModel->updateComment($id_comment, $data['comment_content'], $valide);
                if ($setComment) {
                    echo json_encode(array(
                        'success' => true
                    ));
                }
            } else {
                throw new \Exception(' you can\'t update, this not your comment');
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

    public function deleteComment($id_comment)
    {
        $id_user = $this->session->getUserVar('id');
        $is_admin = $this->session->getUserVar('is_admin');
        $user = $this->getOneComment($id_comment)->getIdUser();

        try {
            if ($id_user === $user || $is_admin === 'Admin') {
                $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
                $deleteComment = $commentModel->deleteComment($id_comment);
                if ($deleteComment == true) {
                    echo json_encode(array("success" => true));
                }
            } else {
                throw new \Exception(' you can\'t remove a comment , you doesn\'t have the right');
            }
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * get comments need validation
     * @return View
     */

    public function getCommentNeedValidate()
    {
        $valide = 0;
        $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
        $comments = $commentModel->getCommentsNotValidate($valide);
        return  $this->view('admin/commentValidate.twig', compact('comments'));
    }

    /**
     * Validation comment
     * @param String $id_comment
     * @return True or msg error
     */

    public function commentValide($id_comment)
    {
        $valide = 1;
        try {
            $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
            $valideComment = $commentModel->updateColumnValidation($id_comment, $valide);
            if ($valideComment) {
                echo json_encode(array(
                    'success' => true
                ));
            }
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
