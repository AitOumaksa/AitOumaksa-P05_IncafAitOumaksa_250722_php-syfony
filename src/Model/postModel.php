<?php

namespace App\Model;

class PostModel extends MainModel
{
    /**
     * get all post
     * @return Array
     */

    public function getAllPost()
    {
        $col_table = [
            'post.id',
            'post.title',
            'post.chapo',
            'post.autor',
            'post.createdAt',
            'post.updatedAt'

        ];
        $join = ['user' => 'user.id=post.id_user'];
        $results = $this->selectData($col_table, $join, null, null);
        $custom_array = [];
        foreach ($results as $datas) {
            array_push($custom_array, new PostTable($datas));
        }

        return $custom_array;
    }

    /**
     * get unique post
     * @param Integer $post_id
     * @return Array
     */

    public function getOnePost($post_id)
    {
        $col_table = [
            'post.id',
            'post.title',
            'post.chapo',
            'post.content',
            'post.autor',
            'post.createdAt',
            'post.updatedAt'

        ];
        $join = ['user' => 'user.id=post.id_user'];
        $results = $this->selectOneData($col_table, $join, 'post.id', $post_id, null, null);
        return new PostTable($results);
    }


    /**
     * Add post
     * @param Integer $id_user
     * @param String $title
     * @param String $chapo
     * @param String $content
     * @param String $autor
     * @return BOOL
     */

    public function setPost($id_user, $title, $chapo, $autor, $content)
    {
        $date = date("Y-m-d H:i:s");
        $col_table = ['id_user', 'title', 'chapo', 'autor', 'content', 'createdAt', 'updatedAt'];
        $values = array(
            ':id_user' => $id_user,
            ':title' => $title,
            ':chapo' => $chapo,
            ':autor' => $autor,
            'content' => $content,
            ':createdAt' => $date,
            ':updatedAt' => $date
        );
        // var_dump($values);
        return $this->insertData($col_table, $values);
    }

    /**
     * Updated post
     * @param Integer $id
     * @param String $post_title
     * @param String $post_chapo
     * @param String $post_content
     * @param String $post_autor
     * @return BOOL
     */

    public function updatePost($id, $post_title, $post_chapo, $post_content, $post_autor)
    {
        $date = date("Y-m-d H:i:s");
        $col_table = ['title', 'chapo', 'content', 'updatedAt', 'autor'];
        $key = 'id';
        $keyValue = $id;
        $values = array($post_title, $post_chapo, $post_content, $date, $post_autor);

        return $this->updateData($col_table, $values, $key, $keyValue);
    }

    /**
     * Delete post
     * @param Integer $id
     * @return BOOL
     */

    public function deletePost($id)
    {
        $key = 'id';
        $keyValue = $id;
        return $this->deleteData($key, $keyValue);
    }
}
