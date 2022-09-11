<?php

namespace App\Model;



class commentModel extends MainModel
{

    /**
     * get all comment
     * @param String $post_id
     * @param INT $valide
     * @return Object
     */

    public function getComments($post_id, $valide)
    {
        $col_table = [
            'user.user_name',
            'comment.id',
            'comment.comment_content',
            'comment.id_user',
            'comment.valide',
            'comment.createdAt',
            'comment.updatedAt'

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        $keys = ['comment.id_post', 'comment.valide'];
        $values = [$post_id, $valide];
        $results = $this->selectData($col_table, $join, $keys, $values);
        $custom_array = [];
        foreach ($results as $datas) {

            array_push($custom_array, new commentTable($datas));
        }

        return $custom_array;
    }

    /**
     * get comment need validation 
     * @param INT $valide
     * @return Object
     */

    public function getCommentsNotValidate($valide)
    {
        $col_table = [
            'user.user_name',
            'comment.id',
            'comment.comment_content',
            'comment.id_user',
            'comment.valide',
            'comment.createdAt',
            'comment.updatedAt'

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        $keys = ['comment.valide'];
        $values = [$valide];
        $results =  $this->selectData($col_table, $join, $keys, $values);
        $custom_array = [];
        foreach ($results as $datas) {

            array_push($custom_array, new commentTable($datas));
        }

        return $custom_array;
    }

    /**
     * get One comment
     * @param Integer $comment_id
     * @return Object 
     */

    public function getOneComment($comment_id)
    {
        $col_table = [
            'comment.id',
            'user.user_name',
            'comment.id_user',
            'comment.comment_content',
            'comment.createdAt',
            'comment.updatedAt'

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        $results = $this->selectOneData($col_table, $join, 'comment.id', $comment_id);
        return new commentTable($results);
    }

    /**
     * Add comment
     * @param Integer $id_post
     * @param String $comment_content
     * @param Iteger $id_user
     * @return Mixed
     */

    public function addComment($id_post, $comment_content, $valide, $id_user)
    {
        $date = date("Y-m-d H:i:s");
        $col_table = ['id_post', 'comment_content', 'valide', 'createdAt', 'updatedAt', 'id_user'];

        $values = array($id_post, $comment_content, $valide, $date, $date, $id_user);
        // var_dump($values);
        return $this->insertData($col_table, $values);
    }

    /**
     * update comment
     * @param Integer $id_post
     * @param String $comment_content
     * @param Iteger $id_user
     * @return Mixed
     */

    public function updateComment($id, $comment_content, $valide)
    {

        $date = date("Y-m-d H:i:s");
        $col_table = ['comment_content', 'valide', 'updatedAt'];
        $key = 'id';
        $keyValue = $id;
        $values = array($comment_content, $valide, $date);

        return $this->updateData($col_table, $values, $key, $keyValue);
    }

    /**
     * UPdate validation column 
     * @param String $id
     * @param INT $valide
     * @return Object
     */

    public function updateColumnValidation($id, $valide)
    {
        $col_table = ['valide'];
        $key = 'id';
        $keyValue = $id;
        $values = array($valide);

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
