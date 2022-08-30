<?php

namespace App\Model;

require_once 'config/ConfigDB.php';

use PDO;

class ConnectDB
{
    /**
     * Stores the Connection
     * @var null
     */
    private static $pdo = null;



    /**
     * Returns the Connection if it exists or creates it before returning it
     * @return PDO|null
     */

    public static function getPDO()
    {

        if (self::$pdo === null) {
            self::$pdo = new PDO(db_Dsn, db_User, db_Pass);
            self::$pdo->exec('SET NAMES UTF8');
        }
        return self::$pdo;
    }
}
