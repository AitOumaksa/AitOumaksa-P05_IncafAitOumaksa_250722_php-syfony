<?php

namespace App\Controller;

use App\Model\ConnectDB;
use App\Model\PDOModel;
use App\Model\commentModel;

class CommentController extends MainController
{
    public function getComments($post_id)
    {
        $col_table = [
            'user.user_name',
            'comment.comment_content',
            'comment.createdAt' => 'datecomment',
            'comment.updatedAt' => 'updatecomment',

        ];
        $join = ['user' => 'user.id = comment.id_user'];
        $commentModel = new commentModel(new PDOModel(ConnectDB::getPDO()));
        $comments = $commentModel->selectData($col_table, $join, 'comment.id_post', $post_id);
        return $comments;
    }
}
