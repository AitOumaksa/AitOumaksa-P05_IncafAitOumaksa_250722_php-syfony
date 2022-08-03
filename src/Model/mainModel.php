<?php

namespace App\Model;

class MainModel
{

    protected $database = null;

    protected $table = null;

    public function __construct(PDOModel $database)
    {
        $this->database = $database;
        $model = explode('\\', get_class($this));
        $this->table = lcfirst(str_replace('Model', '', array_pop($model)));
    }

    public function listData(string $value = null, string $key = null)
    {

        if (isset($key)) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $key . ' = ?';
        } else {
            $query = 'SELECT * FROM ' . $this->table;
        }

        return $this->database->getAllData($query, [$value]);
    }


    public function readData(string $value = null, string $key = null)
    {
        if (isset($key)) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $key . ' = ?';
        } else {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        }

        return $this->database->getData($query, [$value]);
    }
}
