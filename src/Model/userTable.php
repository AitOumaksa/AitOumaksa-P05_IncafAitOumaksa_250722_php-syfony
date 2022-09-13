<?php

namespace App\Model;

class UserTable
{
    /**
     * @var INT $id
     */
    private $id;

    /**
     * @var String $userName
     */
    private $userName;

    /**
     * @var String $mail
     */
    private $mail;

    /**
     * @var String $password
     */
    private $password;

    /**
     * @var String $createdAt
     */

    private $createdAt;

    /**
     * @var String $updatedAt
     */

    private $updatedAt;


    /**
     * @var BOOL $isAdmin
     */
    private $isAdmin;


    public function __construct($datas = [])
    {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * @var Object $datas
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
     * @return INT
     */

    public function getId()
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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param String  $userName
     * @return $userName
     */
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return String
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param Satring $mail
     * @return $mail
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param String $password
     * @return $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return date
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * @param String  $updatedAt
     * @return Date
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
     * @param String  $createdAt
     * @return Date
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    /**
     * @return BOLL
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param String $isAdmin
     * @return BOOL
     */
    public function setIsAdmin(string $isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
}
