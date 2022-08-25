<?php

namespace App\Model;


class PDOModel
{

    public function getData($req)
    {

        $request = ConnectDB::getPDO()->prepare($req);
        // var_dump($request);
        $request->execute();
        return $request->fetch();
    }


    public function getAllData(string $req, array $param)
    {
        $req = ConnectDB::getPDO()->prepare($req);

        $req->execute($param);
        return $req->fetchAll();
    }


    public function setData(string $req, array $params = [])
    {

        $request = ConnectDB::getPDO()->prepare($req);
        return $request->execute($params);
    }
}
