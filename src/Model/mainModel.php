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

    public function selectAllPosts(array $join_tables, $col_tables)
    {
        $query_join = null;
        $query_col = null;
        $count_col = null;


        foreach ($join_tables as $table => $condition) {
            $query_join .= ' INNER JOIN ' . $table . ' ON ' . $condition;
        }

        foreach ($col_tables as $col => $label) {
            if (is_string($col)) {
                $label = 'AS ' . $label;
            } else {

                $col = $label;
                $label = '';
            }
            $count_col++;
            if ($count_col > 1) {
                $query_col .=  ',' . $col . ' ' . $label;
            } else {
                $query_col .=   $col . ' ' . $label;
            }
        }
        //$query_filter = ' WHERE ' . $this->table . '.' . $key . ' = ?';

        $query = 'SELECT ' . $query_col . ' FROM ' . $this->table . ' ' . $query_join;
        return $this->database->getAllData($query, []);
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
