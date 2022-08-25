<?php

namespace App\Model;



class PostModel extends MainModel
{

    public function setPost($id_user, $title, $chapo, $autor, $content)
    {

        $query = 'INSERT INTO ' . $this->table . ' (id_user, title, chapo,autor, content, createdAt,updatedAt) VALUES (?, ?, ?, ?, ?,?,?)';
        $date = date("Y-m-d H:i:s");
        $value = array($id_user, $title, $chapo, $autor, $content, $date, $date);
        // var_dump($value);
        return $this->database->setData($query, $value);
    }

    public function updatePost($id, $post_title, $post_chapo, $post_content, $post_autor)
    {

        $date = date("Y-m-d H:i:s");

        $query = 'UPDATE ' . $this->table . ' SET post.title =?, post.chapo =?,
        post.content =?, post.updatedAt =?, post.autor =? WHERE post.id = ' . $id;

        $value = array($post_title, $post_chapo, $post_content, $date, $post_autor);
        return $this->database->setData($query, $value);
    }

    public function deletePost($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE post.id =' . $id;
        return $this->database->getData($query);
    }
}
