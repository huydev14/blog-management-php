<?php

// Admin auth routes
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');

$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');

$router->get('/forgot', 'AuthController@showForgot');
$router->post('/forgot', 'AuthController@forgot');

$router->get('/active', 'AuthController@active');

$router->get('/reset', 'AuthController@showReset');
$router->post('/reset', 'AuthController@reset');

$router->get('/logout', 'AuthController@logout');

// Admin dashboard
$router->get('/dashboard', 'DashboardController@index');

// Admin post management routes
$router->get('/posts', 'PostController@index');

$router->get('/posts/add', 'PostController@showAdd');
$router->post('/posts/add', 'PostController@add');

$router->get('/posts/edit', 'PostController@showEdit');
$router->post('/posts/edit', 'PostController@edit');

$router->get('/posts/delete', 'PostController@delete');

// Admin category management routes
$router->get('/categories', 'CategoryController@index');
$router->get('/categories/add', 'CategoryController@showAdd');

$router->post('/categories/add', 'CategoryController@add');
$router->get('/categories/edit', 'CategoryController@showEdit');

$router->post('/categories/edit', 'CategoryController@edit');

$router->get('/categories/delete', 'CategoryController@delete');

// Admin user management routes
$router->get('/users', 'UserController@index');

$router->get('/users/add', 'UserController@showAdd');
$router->post('/users/add', 'UserController@add');

$router->get('/users/edit', 'UserController@showEdit');
$router->post('/users/edit', 'UserController@edit');

$router->get('/users/delete', 'UserController@delete');


// Public routes
$router->get('/', 'HomeController@index');
$router->get('/archive', 'HomeController@archive');
$router->get('/about', 'HomeController@about');
$router->get('/post', 'PostController@show');

// For debug
// echo '<pre>';
// print_r($router->getRoute());
// echo '</pre>';
