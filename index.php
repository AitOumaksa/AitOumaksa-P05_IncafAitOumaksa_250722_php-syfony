<?php

require 'vendor/autoload.php';


use App\Router;

Router::get('/', 'MainController@afficheHome');
Router::get('/posts', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getOnePost');
Router::run();


echo 'Bonjour';
