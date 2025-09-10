const cards = [
    { id: 'calendario-paroquial', url: '/admin/calendario' },
    { id: 'gerenciar-eventos', url: '/admin/eventos' },
    { id: 'gerenciar-usuarios', url: '/admin/usuarios' },
    { id: 'gerenciar-sacramentos', url: '/admin/sacramentos' }
];

cards.forEach(card => {
    const element = document.getElementById(card.id);
    if (element) {
        element.addEventListener('click', () => {
            window.location.href = card.url;
        });
    }
});