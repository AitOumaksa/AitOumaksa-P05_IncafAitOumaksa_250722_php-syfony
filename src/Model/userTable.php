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


    public function __construct(array $datas = [])
    {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }

    /**
     * @param Array $datas
     *  @return void 
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

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param INT $id
     * @return Object
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
     * @return Object
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
     * @return Object
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
     * @return Object
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
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
     * @param String  $updatedAt
     * @return Object
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
     * @param String  $createdAt
     * @return Object
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    /**
     * @return Bool
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param Bool $isAdmin
     * @return Object
     */
    public function setIsAdmin(string $isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
}
