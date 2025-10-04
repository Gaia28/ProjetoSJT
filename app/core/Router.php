<?php


class Router
{
    public function handle(string $url): void
    {
        $url = trim($url, '/');

        switch ($url) {
        case '':
            require dirname(__DIR__) . '/controllers/CalendarioController.php';
            $calendario = new CalendarioParoquial();
            $eventos = $calendario->buscarProgramacao();

            require dirname(__DIR__) . '/views/Home.php';
            break;

            case 'home':
                        require dirname(__DIR__) . '/controllers/CalendarioController.php';
            $calendario = new CalendarioParoquial();
            $eventos = $calendario->buscarProgramacao();

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
                   $calendarioParoquial = new CalendarioParoquial();
                   $calendarioParoquial->mostrarCalendario();
                break;

            case 'calendarioParoquial':
                
                require dirname(__DIR__) . '/controllers/CalendarioController.php';
                $calendarioParoquial = new CalendarioParoquial();
                if($_SERVER['REQUEST_METHOD'] ==='POST'){
                    $calendarioParoquial->cadastrarProgramacao();
                }else{
                $calendarioParoquial->mostrarCalendario();
                }
                break;

                case 'editarEvento':
                    require dirname(__DIR__) . '/controllers/CalendarioController.php';
                    $controller = new CalendarioParoquial();

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller->editarProgramacao();
                    }
                    break;
                case 'excluirProgramacao':
                    require dirname(__DIR__) . '/controllers/CalendarioController.php';
                    $controller = new CalendarioParoquial();

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller->excluirProgramacao();
                    }
                    break;

                    case "Liturgia":
                        require dirname(__DIR__) . '/controllers/LiturgiaController.php';
                        $liturgiaController = new LiturgiaController();
                        $liturgiaController->mostrarLiturgia();
                        break;

                       case 'nossosSacramentos':
                        require dirname(__DIR__) . '/controllers/SacramentosController.php';
                        $ctrl = new SacramentosController();
                        $sacramentos = $ctrl->listarSacramentos(); // pega os sacramentos
                        require dirname(__DIR__) . '/views/HomeSacramento.php';
                        break;


                    case "sacramentos":
                        require dirname(__DIR__) . '/controllers/SacramentosController.php';
                        $sacramentosController = new SacramentosController();
                       if($_SERVER['REQUEST_METHOD'] ==='POST'){
                        $sacramentosController->cadastrarSacramento();
                       }else{
                        $sacramentosController->mostrarSacramentos();
                       }
                        break;

                        case 'editarSacramento':
                            require dirname(__DIR__) . '/controllers/SacramentosController.php';
                            $ctrl = new SacramentosController();
                            $ctrl->editarSacramento();
                            break;

                        case 'deletarSacramento':
                            require dirname(__DIR__) . '/controllers/SacramentosController.php';
                            $ctrl = new SacramentosController();
                            $ctrl->deletarSacramento();
                            break;

                        case 'Pastorais':
                            require dirname(__DIR__) . '/controllers/PastoraisController.php';
                            $ctrl = new Pastorais();
                            $pastorais = $ctrl->buscarPastorais(); // pega os dados
                            require dirname(__DIR__) . '/views/PastoraisAdmin.php';
                            break;

                        case 'salvarPastoral':
                            require dirname(__DIR__) . '/controllers/PastoraisController.php';
                            $ctrl = new Pastorais();

                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $ctrl->salvarPastoral();
                            } else {
                                $ctrl->buscarPastorais();
                            }
                            break;
                        case 'excluirPastoral':
                            require dirname(__DIR__) . '/controllers/PastoraisController.php';
                            $ctrl = new Pastorais();
                            $ctrl->excluirPastoral();
                            break;



            default:
                http_response_code(404);
                echo "<h1>404 - Página não encontrada</h1>";
                break;
        }
    }
    
}
