<?php

namespace App\Model;


class PDOModel
{

    public function getData($statement)
    {
        $req = ConnectDB::getPDO()->prepare($statement);
        $req->execute();
        return $req->fetch();
    }


    public function getAllData(string $req, array $param)
    {
        $req = ConnectDB::getPDO()->prepare($req);
        $req->execute($param);
        return $req->fetchAll();
    }


    public function setData(string $statement, array $params = [])
    {
        $req = ConnectDB::getPDO()->prepare($statement);
        return $req->execute($params);
    }
}
