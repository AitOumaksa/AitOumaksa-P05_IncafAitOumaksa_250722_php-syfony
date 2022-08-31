<?php

namespace App\Model;


class PDOModel
{

    /**
     * Returns a unique result from the Database
     * @param string $req
     * @return Mixed
     */

    public function getData($req, array $params)
    {

        $request = ConnectDB::getPDO()->prepare($req);
        $request->execute($params);
        // var_dump($request->execute($params));
        return $request->fetch();
    }

    /**
     * Returns many results from the Database
     * @param String $req
     * @param Array $param
     * @return Array|Mixed
     */

    public function getAllData(string $req, array $params)
    {
        $req = ConnectDB::getPDO()->prepare($req);
        $req->execute($params);
        //var_dump($req);
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

        $db = ConnectDB::getPDO();
        $request = $db->prepare($req);
        //  var_dump($request = $db->prepare($req));
        if ($request->execute($params)) {
            return $db->lastInsertId();
        } else {
            return 'nok';
        };
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
