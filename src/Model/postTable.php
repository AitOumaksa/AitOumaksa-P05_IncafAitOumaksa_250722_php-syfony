<?php

namespace App\Model;

use DateTime;

class PostTable
{
    /**
     * @var int $id post id
     */
    private $id;
    /**
     * @var string $title title post
     */
    private $title;

    /**
     * @var string $chapo chapo post
     */
    private $chapo;

    /**
     * @var string $content content post
     */
    private $content;

    /**
     * @var int $id_user
     */
    private $id_user;

    /**
     * @var string $date_creation post date creation
     */
    private $createdAt;

    /**
     * @var string $date_update post date update
     */
    private $updatedAt;

    /**
     * @var string $autor post autor
     */
    private $autor;

    /**
     * @var string $imgUrl post imgUrl
     */
    private $imgUrl;

    public function __construct(array $datas = [])
    {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * @param Array $datas
     */

    public function hydrate(array $datas)
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
     * @return INT
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * @param INT $id
     * @return $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $title
     * @return $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return String
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param String $chapo
     * @return $chapo
     */
    public function setChapo(string $chapo)
    {
        $this->chapo = $chapo;
        return $this;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param String $content
     * @return $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return String
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param INT $id_user
     * @return $id_user
     */
    public function setIdUser(int $id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @return Date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param String $createdAt
     * @return Date
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
     * @param Date $updatedAt
     * @return Date
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return String
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param String $autor
     * @return $autor
     */
    public function setAutor(string $autor)
    {
        $this->autor = $autor;
        return $this;
    }


    /**
     * @return String
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @param String $imgUrl
     * @return $ImgUrl
     */
    public function setImgUrl(string $imgUrl)
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }
}
