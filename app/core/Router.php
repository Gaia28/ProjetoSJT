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
                require dirname(__DIR__) . '/controllers/AdminController.php';
                $controller = new AdminController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->processarLogin();
                } else {
                    $controller->mostrarLogin();
                }
                break;

            case 'homeAdmin':
                require dirname(__DIR__) . '/views/HomeAdmin.php';
                break;

            case 'calendarioParoquial':
                require dirname(__DIR__) . '/views/CalendarioParoquial.php';
                break;

            default:
                http_response_code(404);
                echo "<h1>404 - Página não encontrada</h1>";
                break;
        }
    }
    
}
