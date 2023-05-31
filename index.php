<?php

// require("vendor/autoload.php");
// $openapi = \OpenApi\Generator::scan(['/app']);
// header('Content-Type: application/json');
// echo $openapi->toJson();

require_once('routes/router.php');
require_once('app/controllers/AuthController.php');
require_once('app/controllers/ProductController.php');
define('auth_controller',new AuthController());
define('product_controller',new ProductController());

 route('/signup', 'POST', function () {
     return auth_controller->signup();
 });

 route('/login', 'POST', function () {
     return auth_controller->login();
 });

 route('/product', 'GET', function () {
     return product_controller->index();
 });

 route('/product', 'POST', function () {
     return product_controller->store();
 });

 route('/product', 'PUT', function () {
     return product_controller->update();
 });

 route('/product', 'DELETE', function () {
     return product_controller->destroy();
 });
 
 $action = $_SERVER['REQUEST_URI'];
 dispatch($action);


?>