<?php

namespace App\Model;

use PDO;

class PDOModel
{
    /**
     * pdo 
     * @var
     */
    private $pdo;

    /**
     * pdo connection construct
     * @param PDO
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Returns a unique result from the Database
     * @param string $req
     * @return Mixed
     */

    public function getData(string $req, array $params = null)
    {

        $request = $this->pdo->prepare($req);
        $request->execute($params);

        return $request->fetch();
    }

    /**
     * Returns many results from the Database
     * @param String $req
     * @param Array $param
     * @return Array|Mixed
     */

    public function getAllData(string $req, array $params = null)
    {
        $req = $this->pdo->prepare($req);
        $req->execute($params);
        return $req->fetchAll();
    }


    /**
     * Executes an action to the Database
     * @param String $req
     * @param Array $params
     * @return BOOL|Mixed
     */

    public function setData(string $req, array $params = [])
    {
        $db = $this->pdo;
        $request = $db->prepare($req);

        return $request->execute($params);
    }


    /**
     * Delete data in the Database
     * @param String $req
     * @return BOOL
     */

    public function deleteData(string $req)
    {
        $request = $this->pdo->prepare($req);
        return  $request->execute();
    }
}
