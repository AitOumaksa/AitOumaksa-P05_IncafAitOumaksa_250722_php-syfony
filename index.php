<?php

require 'vendor/autoload.php';


use App\Router;

Router::get('/', 'MainController@afficheHome');
Router::get('/posts', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getOnePost');
Router::get('/admin', 'AdminController@getPostsAdmin');
Router::post('/addPost', 'PostController@addPost');
Router::post('/contact', 'ContactMailController@sendMessage');
Router::put('/updatePost/{id}', 'PostController@updatePost');
Router::delete('/deletePost/{id}', 'PostController@deletePost');

Router::run();
