<?php
header('Content-Type: application/json');

require_once __DIR__ . '/src/Router.php';



$router = new Router();
$router->handleRequest();
?>