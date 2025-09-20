const cards = [
    { id: 'calendario-paroquial', url: 'calendarioParoquial' },
    { id: 'gerenciar-eventos', url: '/admin/eventos' },
    { id: 'gerenciar-usuarios', url: '/admin/usuarios' },
    { id: 'gerenciar-sacramentos', url: 'sacramentos' }
];

cards.forEach(card => {
    const element = document.getElementById(card.id);
    if (element) {
        element.addEventListener('click', () => {
            window.location.href = card.url;
        });
    }
});

const redesSociais = [
    { id: 'facebook', url: 'https://www.facebook.com/paroquiasaojosedojaguare' },
    { id: 'instagram', url: 'https://www.instagram.com/sjtbelem?igsh=aHo0MWJkbTJoZ3U5' },
    { id: 'youtube', url: 'https://www.youtube.com/channel/UCV8tq1H3b7kXJ4h2bX5F4mA' }
];

redesSociais.forEach(rede => {
    const element = document.getElementById(rede.id);
    if (element) {
        element.addEventListener('click', () => {  
        window.open(rede.url, '_blank');
        });
    }
});