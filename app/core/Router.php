<?php


class Router
{
    public function handle(string $url): void
    {
        $url = trim($url, '/');

        switch ($url) {
          case '':
        case 'home':
            // Carrega dados do Calendário
            require dirname(__DIR__) . '/controllers/CalendarioController.php';
            $calendario = new CalendarioParoquial();
            $eventos = $calendario->buscarProgramacao();

            // Carrega dados dos Próximos Eventos
            require dirname(__DIR__) . '/controllers/EventosController.php';
            $eventosController = new EventosController();
            $proximosEventos = $eventosController->listarProximosEventos(3); 

            // Carrega dados da Liturgia Diária
            require_once dirname(__DIR__) . '/controllers/LiturgiaController.php';
            $liturgiaController = new LiturgiaController();
            $liturgiaDiaria = $liturgiaController->getLiturgiaData();

            // Renderiza a view da Home com todas as variáveis prontas
            require dirname(__DIR__) . '/views/Home.php';
            break;

            case 'admin':
                // ... (o resto do seu router continua igual) ...
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
            case 'processarLogout':
                require dirname(__DIR__) . '/controllers/AdminController.php';
                $controller = new AdminController();
                $controller->processarLogout();
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
            case 'NossasPastorais':
                require dirname(__DIR__) . '/controllers/PastoraisController.php';
                $controller = new PastoraisController();
                $controller->mostrarPastoraisPublico();
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

            case 'editarEventoAdmin': // Usamos um nome único para não conflitar com o calendário
            require dirname(__DIR__) . '/controllers/EventosController.php';
            $controller = new EventosController();
            $controller->editarEvento();
            break;

            case 'excluirEvento':
                require dirname(__DIR__) . '/controllers/EventosController.php';
                $controller = new EventosController();
                $controller->excluirEvento();
                break;
                
            case 'contatos-admin':
                require dirname(__DIR__) . '/controllers/ContatosController.php';
                $controller = new ContatosController();
                $controller->mostrarPainelAdmin();
                break;

            case 'salvar-contato':
                require dirname(__DIR__) . '/controllers/ContatosController.php';
                $controller = new ContatosController();
                $controller->cadastrarContato();
                break;
            
            case 'editar-contato':
                require dirname(__DIR__) . '/controllers/ContatosController.php';
                $controller = new ContatosController();
                $controller->editarContato();
                break;

            case 'excluir-contato':
                require dirname(__DIR__) . '/controllers/ContatosController.php';
                $controller = new ContatosController();
                $controller->excluirContato();
                break;

            case 'nossos-contatos':
                require dirname(__DIR__) . '/controllers/ContatosController.php';
                $controller = new ContatosController();
                $controller->exibirPaginaPublica();
                break;

          
            default:
                http_response_code(404);
                echo "<h1>404 - Página não encontrada</h1>";
                break;
        }
    }
    
}
