<?php

namespace App\Model;

class CommentTable
{
    /**
     * @var INT $id
     */
    private $id;

    /**
     * @var String $comment_content
     */
    private $commentContent;

    /**
     * @var INT $idPost
     */
    private $idPost;

    /**
     * @var String $ date created
     */
    private $createdAt;

    /**
     * @var String $ date update
     */
    private $updatedAt;

    /**
     * @var BOOL $Valide
     */
    private $valide;

    /**
     * @var INT $idUser
     */
    private $idUser;

    /**
     * @var String $username
     */
    private $userName;

    public function __construct(array $datas = [])
    {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * @param  Object $datas
     */

    public function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
            $method = 'set' . ucfirst($key);


            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param String $id
     * @return $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return String
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * @param String $commentContent
     * @return $commentContent
     */
    public function setCommentContent(string $commentContent)
    {
        $this->commentContent = $commentContent;
        return $this;
    }

    /**
     * @return String
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param String $idPost
     * @return $idPost
     */
    public function setIdPost(string $idPost)
    {
        $this->idPost = $idPost;
        return $this;
    }

    /**
     * @return String
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param String $createdAt
     * @return $createdAt
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    /**
     * @return String
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param String $updatedAt
     * @return $updatedAt
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return BOOL
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param String $isValide
     * @return BOOL
     */
    public function setValide(string $valide)
    {
        $this->valide = $valide;
        return $this;
    }

    /**
     * @return String
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param String  $username
     * @return $userNAme
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return INT
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param INT $idUser
     * @return $idUser
     */
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
}
