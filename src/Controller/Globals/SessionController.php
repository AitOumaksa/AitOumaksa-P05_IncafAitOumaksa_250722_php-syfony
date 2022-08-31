<?php

namespace App\Controller\Globals;

class SessionController
{
    const ADMIN = 'Admin';

    const USER = 'User';

    private $session;

    private $user;

    public function __construct()
    {
        $this->session = filter_var_array($_SESSION);

        if (isset($this->session['user'])) {
            $this->user = $this->session['user'];
        }
    }

    public function createSession(array $data)
    {
        if ($data['is_admin'] == 1) $data['is_admin'] = self::ADMIN;
        elseif ($data['is_admin'] == 0) $data['is_admin'] = self::USER;

        $this->session['user'] = [
            'sessionId' => session_id(),
            'id' => $data['id'],
            'user_name' => $data['user_name'],
            'mail' => $data['mail'],
            'createdAt' => $data['createdAt'],
            'updatedAt' => $data['updateddAt'],
            'is_admin' => $data['is_admin']
        ];
        $this->user = $this->session['user'];
        $_SESSION['user'] = $this->session['user'];
        $this->verifyRank();
    }

    public function getUserVar($var)
    {
        return $this->user[$var];
    }
    public function isLogged()
    {
        if (!empty($this->getUserVar('sessionId'))) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        if ($this->getUserVar('is_admin') !== 'Admin') {
            //  header('Location: index.php?page=home');
        }
        return true;
    }

    public function isUser()
    {
        if ($this->getUserVar('is_admin') !== 'User') {
            // header('Location: index.php?page=home');
        }
        return true;
    }


    public function setUserVar(string $var, $data)
    {
        $this->user[$var] = $data;
    }

    private function verifyRank()
    {
        if ($this->getUserVar('is_admin') == 1) {
            $this->setUserVar('is_admin', self::ADMIN);
        } elseif ($this->getUserVar('is_admin') == 0) {
            $this->setUserVar('is_admin', self::USER);
        }
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
    }
}
