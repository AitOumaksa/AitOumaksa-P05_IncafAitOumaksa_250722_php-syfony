<?php

require 'vendor/autoload.php';


use App\Router;

Router::get('/', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getPosts');
Router::run();


echo 'Bonjour';
