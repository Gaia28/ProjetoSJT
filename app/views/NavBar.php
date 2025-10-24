<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <title>Navigation Bar</title>
   
</head>
<body>
    <header>
     <nav class="navbar">
    <div class="navbar-container">
        <a href="home" class="navbar-logo">
            <img src="public/assets/images/logo.PNG" alt="Logo Santuário">
            <span>Paróquia Santuário</span>
        </a>

        <ul class="navbar-menu-desktop">
            <li><a href="home#HomePG2">Sobre Nós</a></li>
            <li><a href="home#HomePG4">Calendário</a></li>
            <li><a href="home#HomePG6">Liturgia</a></li>
            <li><a href="home#doacoes">Doações</a></li>

            <li class="menu-item-has-dropdown">
                <a href="javascript:void(0);" aria-haspopup="true">Saiba mais</a>
                <ul class="dropdown-menu">
                    <li><a href="NossasPastorais">Pastorais</a></li>
                    <li><a href="nossosSacramentos">Sacramentos</a></li>
                    <li><a href="#">Contatos</a></li>
                    <li><a href="admin">Administração</a></li>
                </ul>
            </li>
        </ul>

        <button class="navbar-toggler" id="navbarToggler" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="navbar-menu-mobile" id="navbarMenuMobile">
        <ul>
            <li><a href="home#HomePG2">Sobre Nós</a></li>
            <li><a href="home#HomePG4">Programação</a></li>
            <li><a href="home#HomePG6">Liturgia</a></li>
            <li><a href="nossosSacramentos">Sacramentos</a></li>
            <li><a href="NossasPastorais">Pastorais</a></li>
            <li><a href="#">Contatos</a></li>
            <li><a href="home#doacoes">Doações</a></li>
            <li><a href="admin">Administração</a></li>

        </ul>
    </div>
</nav>
    </header>

    <!-- se você já tem um navbar.js, pode removê-lo ou mantê-lo; o script abaixo é autônomo -->
    
</body>
</html>
