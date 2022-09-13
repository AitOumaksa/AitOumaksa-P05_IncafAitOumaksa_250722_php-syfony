<?php

namespace App\Model;

class MainModel
{
    /**
     * database
     * @var PDOModel
     */

    protected $database = null;

    /**
     * Table database
     * @var String $table
     */

    protected $table = null;

    /**
     * Model constructor
     * Receives the Database Object & creates the Table Name
     * @param PDOModel $database
     */

    public function __construct(PDOModel $database)
    {
        $this->database = $database;
        $model = explode('\\', get_class($this));
        $this->table = lcfirst(str_replace('Model', '', array_pop($model)));
    }


    /**
     * Lists all Datas from the id or another key
     * @param String $value
     * @param String $key
     * @return Array|Mixed
     */

    public function listData($value = null, $key = null)
    {
        if (isset($key)) {
            $query = 'SELECT * FROM ? WHERE ' . $key . ' = ?';
        } else {
            $query = 'SELECT * FROM ?';
        }

        return $this->database->getAllData($query, [$this->table, $value]);
    }

    /**
     * Join a table
     * @param Array $col_tables
     * @param Array $join_tables

     * @return Array|Mixed
     */

    public function selectData(array $col_tables, array $join_tables,  $key,  $value)
    {
        $query_join = null;
        $query_col = null;
        $query_condition = null;
        $count_col = null;
        $query_key = null;

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
        if (isset($key)) {
            if (is_array($key) && is_array($value)) {
                $key[count($key) - 1]  =  $key[count($key) - 1] . '=?';
                $query_key = implode(" =? AND ", $key);
                $query_condition = ' WHERE ' . $query_key;
            } else {
                $query_condition = ' WHERE ' . $key . ' = ?';
            }
        }






        $query = 'SELECT ' . $query_col . ' FROM ' . $this->table . ' ' . $query_join . ' ' . $query_condition . '  ORDER BY ' . $this->table . '.updatedAt  DESC';

        return $this->database->getAllData($query, $value);
    }



    /**
     * Insert data
     * @param Array $col_table
     * @param Array $value
     * @return BOOL
     */

    public function insertData(array $col_table, array $value)
    {
        $query_col = implode(",", $col_table);
        $value_num = array_fill(0, count($col_table), '?');
        $value_req = implode(",", $value_num);

        $query = 'INSERT INTO ' . $this->table . '  (' . $query_col . ')  VALUES (' . $value_req . ')';
        return $this->database->setData($query, $value);
    }

    /**
     * Update data
     * @param Array $col_table
     * @param Array $value
     * @param String $key
     *  @param String $$keyValue
     * @return BOOL
     */


    public function updateData(array $col_table, array $values, string $key, string $keyValue)
    {
        $col_table[count($col_table) - 1]  =  $col_table[count($col_table) - 1] . '=?';
        $query_col = implode("=?,", $col_table);
        $query = 'UPDATE ' . $this->table . ' SET ' . $query_col . ' WHERE ' . $key . ' = ' . $keyValue;
        return $this->database->setData($query, $values);
    }


    /**
     * Delete data
     * @param Sring $key
     * @param String $keyValue
     * @return BOOL
     */

    public function deleteData(string $key, string $keyValue)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $key . ' = ' . $keyValue;
        return $this->database->deleteData($query);
    }


    /**
     * Join a table
     * @param Mixed $col_tables
     * @param Mixed $join_tables
     * @param String $key
     * @param String $value
     * @return Array|Mixed
     */

    public function selectOneData($col_tables, $join_tables, string $key, string $value)
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

        $query = 'SELECT ' . $query_col . ' FROM ' . $this->table . ' ' . $query_join . ' ' . $query_condition;

        return $this->database->getData($query, [$value]);
    }
}
