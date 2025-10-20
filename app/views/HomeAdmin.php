<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/Admin.css">
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <header class="header">
        <div class="circle">
            <img src="public/assets/images/logo.PNG" alt="Logo do Santuário">
        </div>
        <p>Paróquia Santuário São Judas Tadeu</p>
        <nav>
            <a href="home">Sair do Painel</a>
        </nav>
    </header>

    <main>
        <div class="admin-header">
            <h1>Painel de Controle</h1>
            <p>Bem-vindo! Selecione uma seção abaixo para gerenciar o conteúdo do site.</p>
        </div>

        <div class="dashboard-grid">
            
            <a href="calendarioParoquial" class="dashboard-card">
                <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Calendário Paroquial</h3>
                <p>Gerencie as missas e programações semanais recorrentes.</p>
            </a>

            <a href="calendarioParoquial" class="dashboard-card">
                <div class="icon"><i class="fas fa-star"></i></div>
                <h3>Eventos Especiais</h3>
                <p>Adicione e edite os eventos únicos como festas e retiros.</p>
            </a>

            <a href="sacramentos" class="dashboard-card">
                <div class="icon"><i class="fas fa-cross"></i></div>
                <h3>Sacramentos</h3>
                <p>Edite as informações sobre os sacramentos, taxas e documentos.</p>
            </a>

            <a href="Pastorais" class="dashboard-card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h3>Pastorais</h3>
                <p>Gerencie as pastorais e seus respectivos coordenadores.</p>
            </a>

        </div>
    </main>

</body>
</html>