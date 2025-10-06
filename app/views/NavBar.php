<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <title>Navigation Bar</title>
    <style>
        nav ul li {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="circle">
            <img src="public/assets/images/logo.PNG" alt="Logo do Santuário">
            <p>Santuário São Judas Tadeu</p>
        </div>
        
        <div class="menu-toggle" id="menu-toggle">&#9776;</div>
        <nav>
            <ul>
                <li data-target="HomePG2">Home</li>
                <li data-target="HomePG4">Calendário</li>
                <li data-target="doacoes">Doações</li>
                <li class="dropdown">
                    <span>Saiba mais ▾</span>
                    <ul class="dropdown-menu">
                        <li data-target="nossosSacramentos">Sacramentos</li>
                        <li data-target="pastorais">Pastorais</li>
                        <li data-target="equipe">Equipe</li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const nav = document.querySelector('nav');
        const items = document.querySelectorAll('nav ul li[data-target], .dropdown-menu li[data-target]');

        // Mapeamento de páginas
        const routes = {
            HomePG2: "index.php#HomePG2",
            HomePG4: "index.php#HomePG4",
            doacoes: "index.php#doacoes",
            nossosSacramentos: "nossosSacramentos",
            pastorais: "nossasPastorais",
            equipe: "equipe.php"
        };

        // Toggle menu mobile
        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
        });

        // Clique nos itens da navbar
        items.forEach(item => {
            item.addEventListener('click', () => {
                const target = item.getAttribute('data-target');

                if (routes[target]) {
                    window.location.href = routes[target];
                }

                // Fecha o menu no mobile
                nav.classList.remove('active');
            });
        });
    </script>
</body>
</html>
