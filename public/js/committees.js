
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar las pestañas de Bootstrap
    const tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEl.forEach(tab => {
        new bootstrap.Tab(tab);
    });

    // Animación de entrada para las tarjetas
    const cards = document.querySelectorAll('.committee-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
