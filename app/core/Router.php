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

            require dirname(__DIR__) . '/controllers/EventosController.php';
            $eventosController = new EventosController();
            $proximosEventos = $eventosController->listarProximosEventos(3); 

            require_once dirname(__DIR__) . '/controllers/LiturgiaController.php';
            $liturgiaController = new LiturgiaController();
            $liturgiaDiaria = $liturgiaController->getLiturgiaData();

            require dirname(__DIR__) . '/views/Home.php';
            break;

            case 'home':
                        require dirname(__DIR__) . '/controllers/CalendarioController.php';
            $calendario = new CalendarioParoquial();
            $eventos = $calendario->buscarProgramacao();
            require dirname(__DIR__) . '/controllers/EventosController.php';
            $eventosController = new EventosController();
            $proximosEventos = $eventosController->listarProximosEventos(3); 

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

                        // ... outros cases ...

            case 'Pastorais':
                require dirname(__DIR__) . '/controllers/PastoraisController.php';
                $controller = new PastoraisController();
                $controller->mostrarPastorais();
                break;

            case 'salvarPastoral':
                 // A lógica de salvar deve estar no PastoraisController também
                 // Por enquanto, vamos manter o que você tinha, mas o ideal é mover
                 require dirname(__DIR__) . '/controllers/PastoraisController.php';
                 $ctrl = new PastoraisController(); 
                 $ctrl->salvarPastoral();
                 break;

            case 'editarPastoral':
                require dirname(__DIR__) . '/controllers/PastoraisController.php';
                $controller = new PastoraisController();
                $controller->editarPastoral();
                break;
            
            case 'deletarPastoral':
                require dirname(__DIR__) . '/controllers/PastoraisController.php';
                $controller = new PastoraisController();
                $controller->deletarPastoral();
                break;

            case 'getPastoralDetails':
                require dirname(__DIR__) . '/controllers/PastoraisController.php';
                $controller = new PastoraisController();
                $controller->getPastoralDetails();
                break;

             case 'gerenciar-eventos':
                require dirname(__DIR__) . '/controllers/EventosController.php';
                $controller = new EventosController();
                $controller->mostrarPainel();
                break;

            case 'salvarEvento':
                require dirname(__DIR__) . '/controllers/EventosController.php';
                $controller = new EventosController();
                $controller->cadastrarEvento();
                break;

          
            default:
                http_response_code(404);
                echo "<h1>404 - Página não encontrada</h1>";
                break;
        }
    }
    
}
