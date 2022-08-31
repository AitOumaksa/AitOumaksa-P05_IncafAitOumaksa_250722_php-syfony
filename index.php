<?php

require 'vendor/autoload.php';


use App\Router;
//Run route
Router::get('/', 'MainController@afficheHome');
Router::get('/posts', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getOnePost');
Router::get('/admin', 'AdminController@getPostsAdmin');
Router::post('/addPost', 'PostController@addPost');
Router::post('/{id}/addComment', 'CommentController@addComment');
Router::post('/contact', 'ContactMailController@sendMessage');
Router::post('/contact', 'ContactMailController@sendMessage');
Router::post('/signup', 'UserController@signUp');
Router::put('/updatePost/{id}', 'PostController@updatePost');
Router::put('/updateComment/{id}', 'CommentController@updateComment');
Router::delete('/deletePost/{id}', 'PostController@deletePost');
Router::delete('/deleteComment/{id}', 'CommentController@deleteComment');


//Run route
Router::run();
