<?php

//use App\Factory\PDOFactory;
//use App\Manager\UserManager;

require_once 'vendor/autoload.php';

$url = "/" . trim(explode("?", $_SERVER['REQUEST_URI'])[0], "/");

switch ($url) {
    case "/":
        $controller = new \App\Controller\PostController();
        $controller->home();
        break;



    default:
        throw new Exception("RIEN TROUVE !");
}
