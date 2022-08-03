<?php

namespace App;

Router::get('/', 'PostController@getPosts');
Router::get('/home/{id}', 'HomeController');
Router::post('/', 'HomeControllercreat');
