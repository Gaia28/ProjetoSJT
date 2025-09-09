<?php


class Router
{
    public function handle(string $url): void
    {
        $url = trim($url, '/');

        switch ($url) {
            case '':
                require dirname(__DIR__) . '/views/Home.php';
                break;

            case 'admin':
                require dirname(__DIR__) . '/views/AdminLogin.php';
                break;

            case 'homeAdmin':
                require dirname(__DIR__) . '/views/HomeAdmin.php';
                break;

            default:
                http_response_code(404);
                echo "<h1>404 - Página não encontrada</h1>";
                break;
        }
    }
    
}
