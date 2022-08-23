<?php

namespace App\Model;


class PDOModel
{

    public function getData($req)
    {
        $request = ConnectDB::getPDO()->prepare($req);
        $request->execute();
        return $request->fetch();
    }


    public function getAllData(string $req, array $param)
    {
        //var_dump($req);
        $req = ConnectDB::getPDO()->prepare($req);
        // var_dump($param, 'parametre');
        $req->execute($param);
        return $req->fetchAll();
    }


    public function setData(string $req, array $params = [])
    {

        $request = ConnectDB::getPDO()->prepare($req);
        //var_dump($request);
        return $request->execute($params);
    }
}
