document.addEventListener('DOMContentLoaded', function() {
    // Animación de aparición para las tarjetas
    const toolCards = document.querySelectorAll('.tool-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });

    toolCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        card.style.transition = 'all 0.8s ease-out';
        observer.observe(card);
    });

    // Efecto de hover mejorado para las tarjetas
    toolCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
        });
    });

    // Configuración del enlace de Moodle
    const moodleLink = document.getElementById('moodle-link');
    if (moodleLink) {
        // Aquí se actualizará la URL cuando la proporciones
        moodleLink.addEventListener('click', function(e) {
            e.preventDefault();
            // TODO: Actualizar con la URL real de Moodle
            alert('Por favor, proporcione la URL de Moodle para actualizar este enlace.');
        });
    }
}); 