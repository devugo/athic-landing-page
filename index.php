<?php
    require_once 'core/init.php';
    require_once 'api/SubscriberApi.php';

    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    if($uri[1] === 'subscribers'){
        require_once 'public/subscribers.php';
        exit();
    }

     // all of our endpoints start with /person
    // everything else results in a 404 Not Found
    if ($uri[1] !== 'subscribe' || $_SERVER["REQUEST_METHOD"] === 'GET') {
        // header("HTTP/1.1 404 Not Found");
        require_once 'public/index.php';
        exit();
    }

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    $controller = new SubscriberApi($requestMethod);
    $controller->processRequest();