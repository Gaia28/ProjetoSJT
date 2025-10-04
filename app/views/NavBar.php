<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <title>Navigation Bar</title>
</head>
<body>
    <header>
        <div class="circle">
            <img src="public/assets/images/logo.PNG" alt="Logo do Santuário">
        </div>
        <p>Santuário São Judas Tadeu</p>

        <div class="menu-toggle" id="menu-toggle">&#9776;</div>
        <nav>
            <ul>
                <li><a href="#HomePG2">Home</a></li>
                <li><a href="#HomePG4">Calendário</a></li>
                <li><a href="#doacoes">Doações</a></li>
                <li class="dropdown">
                    <a>Saiba mais ▾</a>
                    <ul class="dropdown-menu">
                        <li><a href="nossosSacramentos">Sacramentos</a></li>
                        <li><a href="pastorais">Pastorais</a></li>
                        <li><a href="#">Equipe</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const nav = document.querySelector('nav');

        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>
