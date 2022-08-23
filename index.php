<?php

require 'vendor/autoload.php';


use App\Router;

Router::get('/', 'MainController@afficheHome');
Router::get('/posts', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getOnePost');
Router::get('/admin', 'AdminController@adminInterface');
Router::post('/addPost', 'AdminController@addPost');
Router::post('/contact', 'ContactMailController@sendMessage');

Router::run();
