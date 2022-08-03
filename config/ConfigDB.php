<?php

$host = 'localhost';
$db_Name = 'blog_php';
$db_User = 'root';
$db_Pass = 'Incaf123';
$db_Port = '3307';
$db_Dsn = "mysql:host={$host};dbname={$db_Name};port={$db_Port}";
$option = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

define('db_Name', $db_Name);
define('db_User', $db_User);
define('db_Dsn', $db_Dsn);
define('db_Pass', $db_Pass);
define('option', $option);
