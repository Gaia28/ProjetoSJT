<php
use App\controllers\AdminController;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/Admin.css">
    <title>Administração</title>
</head>
<body>
    <main class="containerHome" role="main"> 
        <header class="header">
         <div class="circle"><img src="public/assets/images/logo.PNG" alt="Logo do Santuário"></div>
            <p>Paróquia Santuário São Judas Tadeu</p>
            <nav>
                <a href="#">Sair</a>
                
            </nav>
    </header>

    <section class="home-content">
        <h1>Bem-vindo ao Painel Administrativo</h1>
        <p>Gerencie o conteúdo do site aqui.</p>

        <div class ="cards">
            <div class="card">
                <h2>Gerenciar Notícias</h2>
                <p>Adicione, edite ou remova notícias do site.</p>
               
            </div>
            <div class="card">
                <h2>Gerenciar Eventos</h2>
                <p>Adicione, edite ou remova eventos do calendário.</p>
            </div>
            <div class="card">
                <h2>Gerenciar Usuários</h2>
                <p>Controle os usuários que têm acesso ao painel administrativo.</p>
            </div>
            <div class="card">
                <h2>Sacaramentos</h2>
                <p>Cadastre os sacramentos realizados no santuário.</p>

        </div>
    </section>
    </main>
</body>

</html>