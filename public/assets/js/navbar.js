document.addEventListener('DOMContentLoaded', () => {
    const navbarToggler = document.getElementById('navbarToggler');
    const navbar = document.querySelector('.navbar');
    const mobileMenuLinks = document.querySelectorAll('.navbar-menu-mobile a');

    if (navbarToggler) {
        navbarToggler.addEventListener('click', () => {
            navbar.classList.toggle('is-active');
        });
    }

    // Fecha o menu ao clicar em um link (útil para páginas de uma só rolagem)
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbar.classList.contains('is-active')) {
                navbar.classList.remove('is-active');
            }
        });
    });
});