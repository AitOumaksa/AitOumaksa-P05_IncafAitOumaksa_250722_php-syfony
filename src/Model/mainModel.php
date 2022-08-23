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
    // 

    public function selectData($col_tables, $join_tables, $key, $value)
    {
        $query_join = null;
        $query_col = null;
        $query_condition = null;
        $count_col = null;

        if (isset($join_tables)) {

            foreach ($join_tables as $table => $condition) {
                $query_join .= ' INNER JOIN ' . $table . ' ON ' . $condition;
            }
        }

        if (isset($col_tables)) {
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
        } else {
            $query_col = '*';
        }

        if (isset($key) && isset($value)) {
            $query_condition = ' WHERE ' . $key . ' = ?';
        }

        $query = 'SELECT ' . $query_col . ' FROM ' . $this->table . ' ' . $query_join . ' ' . $query_condition . '  ORDER BY ' . $this->table . '.updatedAt  DESC';
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

    public function setPost($id_user, $title, $chapo, $autor, $content)
    {

        $query = 'INSERT INTO ' . $this->table . ' (id_user, title, chapo,autor, content, createdAt,updatedAt) VALUES (?, ?, ?, ?, ?,?,?)';
        $date = date("Y-m-d H:i:s");
        $value = array($id_user, $title, $chapo, $autor, $content, $date, $date);
        // var_dump($value);
        return $this->database->setData($query, $value);
    }
}
