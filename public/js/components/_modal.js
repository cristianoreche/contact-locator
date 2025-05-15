document.addEventListener('DOMContentLoaded', () => {
    // Abre o modal ao clicar em um botão com data-modal-target="id-do-modal"
    document.querySelectorAll('[data-modal-target]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(targetId);

            if (modal && modal.classList.contains('uc-modal')) {
                modal.style.display = 'flex'; // usa flex para centralizar
                modal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('modal-open'); // opcional: trava rolagem
            }
        });
    });

    // Fecha o modal ao clicar em qualquer elemento com data-modal-close
    document.querySelectorAll('[data-modal-close]').forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.uc-modal');

            if (modal) {
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('modal-open');
            }
        });
    });
});
