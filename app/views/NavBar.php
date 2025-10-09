<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <title>Navigation Bar</title>
    <style>
        nav ul li { cursor: pointer; }
        /* classe simples para abrir menu mobile */
        .navbar-menu-mobile.open { display: block; }
    </style>
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
            <li><a href="#HomePG2">Sobre Nós</a></li>
            <li><a href="#HomePG4">Calendário</a></li>
            <li><a href="#HomePG6">Liturgia</a></li>
            <li><a href="#doacoes">Doações</a></li>

            <li class="menu-item-has-dropdown">
                <a href="#">Saiba mais</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pastorais</a></li>
                    <li><a href="nossosSacramentos">Sacramentos</a></li>
                    <li><a href="#">Contatos</a></li>
                    <li><a href="#">Administração</a></li>
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
            <li><a href="#HomePG2">Sobre Nós</a></li>
            <li><a href="#HomePG4">Programação</a></li>
            <li><a href="#HomePG6">Liturgia</a></li>
            <li><a href="nossosSacramentos">Sacramentos</a></li>
            <li><a href="#">Pastorais</a></li>
            <li><a href="#">Contatos</a></li>
            <li><a href="#">Administração</a></li>
            <li><a href="#doacoes">Doações</a></li>
            <li><a href="admin">Admin</a></li>
        </ul>
    </div>
</nav>
    </header>

    <!-- se você já tem um navbar.js, pode removê-lo ou mantê-lo; o script abaixo é autônomo -->
    <script>
    (function () {
        // mapeamento de rotas — ajuste conforme seu router
        const routes = {
            HomePG2: "index.php#HomePG2",
            HomePG4: "index.php#HomePG4",
            HomePG6: "index.php#HomePG6",
            doacoes: "index.php#doacoes",
            nossosSacramentos: "nossosSacramentos",
            pastorais: "Pastorais",
            admin: "admin",
            equipe: "equipe.php"
        };

        const toggler = document.getElementById('navbarToggler');
        const mobileMenu = document.getElementById('navbarMenuMobile');
        const desktopLinks = document.querySelectorAll('.navbar-menu-desktop a[data-target]');
        const mobileLinks = document.querySelectorAll('#navbarMenuMobile a[data-target]');

        // Toggle menu mobile (aria + classe)
        toggler.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            if (isOpen) {
                mobileMenu.style.display = 'block';
                mobileMenu.setAttribute('aria-hidden', 'false');
                toggler.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.style.display = 'none';
                mobileMenu.setAttribute('aria-hidden', 'true');
                toggler.setAttribute('aria-expanded', 'false');
            }
        });

        // função utilitária para navegar usando o map de rotas
        function navigateTo(targetKey) {
            if (!targetKey) return;
            const route = routes[targetKey];

            if (route) {
                // redireciona
                window.location.href = route;
            } else {
                // se não tiver rota mapeada, tenta navegar por hash (fallback)
                window.location.hash = targetKey;
            }
        }

        // handler compartilhado para cliques
        function onNavClick(e) {
            e.preventDefault();
            const key = this.dataset.target;
            navigateTo(key);
            // fecha menu mobile se estiver aberto
            if (mobileMenu.classList.contains('open')) {
                mobileMenu.classList.remove('open');
                mobileMenu.style.display = 'none';
                mobileMenu.setAttribute('aria-hidden', 'true');
                toggler.setAttribute('aria-expanded', 'false');
            }
        }

        // liga eventos
        desktopLinks.forEach(a => a.addEventListener('click', onNavClick));
        mobileLinks.forEach(a => a.addEventListener('click', onNavClick));

        // comportamento: se a URL atual é index.php com hash, marca visual (opcional)
        function highlightActive() {
            const currentHash = window.location.hash.replace('#','');
            document.querySelectorAll('.navbar-menu-desktop a, #navbarMenuMobile a').forEach(a => {
                a.classList.toggle('active', a.dataset.target === currentHash);
            });
        }
        window.addEventListener('hashchange', highlightActive);
        highlightActive();

        // Fechar menu ao clicar fora (opcional e simples)
        document.addEventListener('click', (ev) => {
            const inside = ev.target.closest('.navbar');
            if (!inside && mobileMenu.classList.contains('open')) {
                mobileMenu.classList.remove('open');
                mobileMenu.style.display = 'none';
                mobileMenu.setAttribute('aria-hidden', 'true');
                toggler.setAttribute('aria-expanded', 'false');
            }
        });
    })();
    </script>
</body>
</html>
