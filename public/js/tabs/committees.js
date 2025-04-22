document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('committeeSearch');
    const committeeCards = document.querySelectorAll('.committee-card');
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const deleteCommitteeForm = document.getElementById('deleteCommitteeForm');
    const committeeNameToDelete = document.getElementById('committeeNameToDelete');
    const deleteModal = document.getElementById('deleteCommitteeModal');

    // Función para generar el slug
    function generateSlug(text) {
        return text.toLowerCase()
            .replace(/[áàäâã]/g, 'a')
            .replace(/[éèëê]/g, 'e')
            .replace(/[íìïî]/g, 'i')
            .replace(/[óòöôõ]/g, 'o')
            .replace(/[úùüû]/g, 'u')
            .replace(/ñ/g, 'n')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }

    // Generar slug cuando se escribe en el campo nombre
    nameInput.addEventListener('input', function() {
        slugInput.value = generateSlug(this.value);
    });

    // Configurar el modal de eliminación
    deleteModal.addEventListener('show.bs.modal', function(event) {
        
        const button = event.relatedTarget;
        const committeeId = button.getAttribute('data-committee-id');
        const committeeName = button.getAttribute('data-committee-name');

        // Actualizar el nombre en el modal
        committeeNameToDelete.textContent = committeeName;

        // Actualizar la acción del formulario
        deleteCommitteeForm.action = `/committees/${committeeId}`;
    });


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