document.addEventListener('DOMContentLoaded', () => {
    const promoModal = document.getElementById('promoModal');
    if (!promoModal) return;

    promoModal.addEventListener('show.bs.modal', event => {
        const triggerCard = event.relatedTarget;
        
        // Extract info from data-* attributes
        const title = triggerCard.getAttribute('data-title');
        const desc = triggerCard.getAttribute('data-desc');
        const img = triggerCard.getAttribute('data-img');

        // Update the modal's content
        const modalTitle = promoModal.querySelector('#promoModalTitle');
        const modalDesc = promoModal.querySelector('#promoModalDesc');
        const modalImg = promoModal.querySelector('#promoModalImg');

        modalTitle.textContent = title;
        modalDesc.textContent = desc;
        modalImg.src = img;
    });
});
