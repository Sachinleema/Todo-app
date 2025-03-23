<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Show Register and Login Forms
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('login');

$routes->get('/', 'AuthController::login');


$routes->get('login', 'AuthController::login');
$routes->post('loginUser', 'AuthController::loginUser');

$routes->get('register', 'AuthController::register');
$routes->post('registerUser', 'AuthController::registerUser');

$routes->get('dashboard', 'AuthController::dashboard');
$routes->get('logout', 'AuthController::logout');



//Todopage routes
$routes->get('dashboard', 'TodoController::index');

$routes->post('addTodo', 'TodoController::addTodo');
$routes->get('deleteTodo/(:num)', 'TodoController::deleteTodo/$1');
$routes->get('editTodo/(:num)', 'TodoController::editTodo/$1');
$routes->post('updateTodo', 'TodoController::updateTodo');

