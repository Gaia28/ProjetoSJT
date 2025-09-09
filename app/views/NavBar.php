<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <title>Navigation Bar</title>

</head>
<body>
    <header>
            <div class="circle"><img src="public/assets/images/logo.PNG" alt="Logo do Santuário"></div>
            <p>Santuário São Judas Tadeu</p>
            <div class="menu-toggle" id="menu-toggle">&#9776;</div>
            <nav>
                <a href="#">Home</a>
                <a href="#">Eventos</a>
                <a href="#">Doações</a>
                <a href="#">Contato</a>
            </nav>
        </header>
</body>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const nav = document.querySelector('nav');

    menuToggle.addEventListener('click', () => {
        nav.classList.toggle('active');
    });
</script>
</html>