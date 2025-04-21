document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('committeeSearch');
    const committeeCards = document.querySelectorAll('.committee-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        committeeCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const description = card.getAttribute('data-description');
            
            if (name.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});