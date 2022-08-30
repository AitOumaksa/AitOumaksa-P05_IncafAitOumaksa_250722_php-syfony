<?php

namespace App\Model;



class commentModel extends MainModel
{

    /**
     * get all comment
     * @param Integer $post_id
     * @return BOOL
     */

    public function getComments($post_id)
    {
        $col_table = [
            'user.user_name',
            'comment.id'  => 'id_comment',
            'comment.comment_content',
            'comment.createdAt' => 'datecomment',
            'comment.updatedAt' => 'updatecomment',

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        return $this->selectData($col_table, $join, 'comment.id_post', $post_id);
    }

    /**
     * get One comment
     * @param Integer $comment_id
     * @return BOOL
     */

    public function getOneComment($comment_id)
    {
        $col_table = [
            'comment.id'  => 'id_comment',
            'user.user_name',
            'comment.comment_content',
            'comment.createdAt' => 'datecomment',
            'comment.updatedAt' => 'updatecomment',

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        return $this->selectData($col_table, $join, 'comment.id', $comment_id);
    }

    /**
     * Add comment
     * @param Integer $id_post
     * @param String $comment_content
     * @param Iteger $id_user
     * @return Mixed
     */

    public function addComment($id_post, $comment_content, $id_user)
    {
        $date = date("Y-m-d H:i:s");
        $col_table = ['id_post', 'comment_content', 'createdAt', 'updatedAt', 'id_user'];

        $values = array($id_post, $comment_content, $date, $date, $id_user);
        return $this->insertData($col_table, $values);
    }

    /**
     * update comment
     * @param Integer $id_post
     * @param String $comment_content
     * @param Iteger $id_user
     * @return Mixed
     */

    public function updateComment($id, $comment_content)
    {

        $date = date("Y-m-d H:i:s");
        $col_table = ['comment_content', 'updatedAt'];
        $key = 'id';
        $keyValue = $id;
        $values = array($comment_content, $date);

        return $this->updateData($col_table, $values, $key, $keyValue);
    }


    /**
     * Delete comment
     * @param Integer $id
     * @return BOOL
     */

    public function deleteComment($id)
    {
        $key = 'id';
        $keyValue = $id;
        return $this->deleteData($key, $keyValue);
    }
}
