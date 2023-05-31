<?php

$routes = [];

function route($action, $method, Closure $callback)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$method][$action] = $callback;
}

function dispatch($action)
{   
    global $routes;
    $action = trim($action, '/');
    $callback = $routes[$_SERVER['REQUEST_METHOD']][$action];

    if(!$callback){
        http_response_code(404);
        echo "Route not found";
        die();
    }

    echo call_user_func($callback);
}