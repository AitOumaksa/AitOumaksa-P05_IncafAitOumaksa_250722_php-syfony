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

    public function listData(string $value = null, string $key = null)
    {

        if (isset($key)) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $key . ' = ?';
        } else {
            $query = 'SELECT * FROM ' . $this->table;
        }

        return $this->database->getAllData($query, [$value]);
    }

    /**
     * Join a table 
     * @param Mixed $col_tables
     * @param Mixed $join_tables
     * @param String $key
     * @param String $value
     * @return Array|Mixed
     */

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



    /**
     * Insert data 
     * @param Array $col_table
     * @param String|Array $value
     * @return BOOL
     */

    public function insertData($col_table, $value)
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
     * @param String|Array $value
     * @param String $key
     *  @param String $$keyValue
     * @return BOOL
     */


    public function updateData($col_table, $values, $key, $keyValue)
    {
        $col_table[count($col_table) - 1]  =  $col_table[count($col_table) - 1] . '=?';
        $query_col = implode("=?,", $col_table);
        $query = 'UPDATE ' . $this->table . ' SET ' . $query_col . ' WHERE ' . $key . ' = ' . $keyValue;
        return $this->database->setData($query, $values);
    }


    /**
     * Delete data 
     * @param String $key
     * @param String $keyValue
     * @return BOOL
     */

    public function deleteData($key, $keyValue)
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

    public function selectOneData($col_tables, $join_tables, $key, $value)
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
