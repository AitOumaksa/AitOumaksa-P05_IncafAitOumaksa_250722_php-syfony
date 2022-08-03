<?php

namespace App\Model;

require_once 'config/ConfigDB.php';

use PDO;

class ConnectDB
{
    private static $pdo = null;
    public static function getPDO()
    {

        if (self::$pdo === null) {
            self::$pdo = new PDO(db_Dsn, db_User, db_Pass);
            self::$pdo->exec('SET NAMES UTF8');
        }
        return self::$pdo;
    }
}
