const cards = [
    { id: 'calendario-paroquial', url: 'calendarioParoquial' },
    { id: 'gerenciar-pastorais', url: 'Pastorais' },
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
    { id: 'facebook', url: 'https://www.facebook.com/share/1F8TDq5ui3/' },
    { id: 'instagram', url: 'https://www.instagram.com/sjtbelem?igsh=aHo0MWJkbTJoZ3U5' },
    { id: 'whatsapp', url: 'https://api.whatsapp.com/send?phone=%2B559131156020&fbclid=IwVERDUAM_XpdleHRuA2FlbQIxMAABHpZIiLmAbO6WuyF2V002scb7y63wP5js9ohScUO8wSuyVBmN_Y_z-HVuu_Hz_aem_Fv4CknDfFkCB6sK4oaqjrQ' }
];

redesSociais.forEach(rede => {
    const element = document.getElementById(rede.id);
    if (element) {
        element.addEventListener('click', () => {  
        window.open(rede.url, '_blank');
        });
    }
});