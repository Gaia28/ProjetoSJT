<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/core/Router.php';

// Captura a URL da query string
$url = $_GET['url'] ?? '';

// Instancia e processa a rota
$router = new Router();
$router->handle($url);