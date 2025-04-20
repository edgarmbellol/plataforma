document.addEventListener('DOMContentLoaded', function() {
    // Animación de scroll para las secciones con efecto de aparición
    const sections = document.querySelectorAll('.section');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });

    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(50px)';
        section.style.transition = 'all 0.8s ease-out';
        observer.observe(section);
    });

    // Efecto parallax mejorado para la sección hero
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            const speed = 0.5;
            
            // Efecto parallax suave
            heroSection.style.backgroundPositionY = -(currentScroll * speed) + 'px';
            
            // Efecto de profundidad en el contenido
            const heroContent = heroSection.querySelector('.hero-content');
            const depth = (currentScroll - lastScroll) * 0.1;
            heroContent.style.transform = `translateY(${depth}px)`;
            
            lastScroll = currentScroll;
        });
    }

    // Smooth scroll mejorado para los enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
                const startPosition = window.pageYOffset;
                const distance = targetPosition - startPosition;
                let startTime = null;
                
                function animation(currentTime) {
                    if (startTime === null) startTime = currentTime;
                    const timeElapsed = currentTime - startTime;
                    const run = ease(timeElapsed, startPosition, distance, 1000);
                    window.scrollTo(0, run);
                    if (timeElapsed < 1000) requestAnimationFrame(animation);
                }
                
                function ease(t, b, c, d) {
                    t /= d / 2;
                    if (t < 1) return c / 2 * t * t + b;
                    t--;
                    return -c / 2 * (t * (t - 2) - 1) + b;
                }
                
                requestAnimationFrame(animation);
            }
        });
    });

    // Efecto de hover mejorado para las tarjetas
    const cards = document.querySelectorAll('.card-hover, .value-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.1)';
        });
    });

    // Efecto de zoom mejorado para la galería
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const img = this.querySelector('img');
            const overlay = this.querySelector('.overlay');
            
            img.style.transform = 'scale(1.1)';
            overlay.style.opacity = '1';
            
            const icon = overlay.querySelector('i');
            icon.style.transform = 'scale(1) rotate(360deg)';
        });
        
        item.addEventListener('mouseleave', function() {
            const img = this.querySelector('img');
            const overlay = this.querySelector('.overlay');
            
            img.style.transform = 'scale(1)';
            overlay.style.opacity = '0';
            
            const icon = overlay.querySelector('i');
            icon.style.transform = 'scale(0)';
        });
    });
}); 