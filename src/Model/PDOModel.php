<?php

namespace App\Model;

class PDOModel
{
    /**
     * Returns a unique result from the Database
     * @param string $req
     * @return Mixed
     */

    public function getData($req, $params)
    {
        $request = ConnectDB::getPDO()->prepare($req);
        $request->execute($params);
        return $request->fetch();
    }

    /**
     * Returns many results from the Database
     * @param String $req
     * @param Array $param
     * @return Array|Mixed
     */

    public function getAllData(string $req, $params)
    {
        $req = ConnectDB::getPDO()->prepare($req);
        $req->execute($params);
        return $req->fetchAll();
    }


    /**
     * Executes an action to the Database
     * @param String $req
     * @param Array $params
     * @return BOOL|Mixed
     */

    public function setData(string $req, $params = [])
    {
        $db = ConnectDB::getPDO();
        $request = $db->prepare($req);
        //  var_dump($request = $db->prepare($req));
        return $request->execute($params);
    }


    /**
     * Delete data in the Database
     * @param String $req
     * @return BOOL
     */

    public function deleteData($req)
    {
        $request = ConnectDB::getPDO()->prepare($req);
        return  $request->execute();
    }
}
