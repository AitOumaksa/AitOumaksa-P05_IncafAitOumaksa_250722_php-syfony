<?php

require 'vendor/autoload.php';

session_start();

use App\Router;

//Routes 
Router::get('/', 'MainController@afficheHome');
Router::get('/posts', 'PostController@getPosts');
Router::get('/post/{id}', 'PostController@getOnePost');
Router::get('/admin', 'AdminController@getPostsAdmin');
Router::get('/adminInterface', 'UserController@adminPage');
Router::get('/connexion', 'UserController@loginPage');
Router::get('/inscription', 'UserController@signUpPage');
Router::get('/deconnexion', 'UserController@logout');
Router::get('/validationComment', 'CommentController@getCommentNeedValidate');
Router::get('/validation/{id}', 'CommentController@commentValide');
Router::get('/noValidation/{id}', 'CommentController@deleteComment');

Router::post('/addPost', 'PostController@addPost');
Router::post('/{id}/addComment', 'CommentController@addComment');
Router::post('/contact', 'ContactMailController@sendMessage');
Router::post('/signup', 'UserController@signUp');
Router::post('/login', 'UserController@login');

Router::put('/updatePost/{id}', 'PostController@updatePost');
Router::put('/updateComment/{id}', 'CommentController@updateComment');

Router::delete('/deletePost/{id}', 'PostController@deletePost');
Router::delete('/deleteComment/{id}', 'CommentController@deleteComment');


//Run route
Router::run();
