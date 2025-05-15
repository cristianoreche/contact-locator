// header.js — Interações do topo (ex: logout, dropdown, toggle menu futuramente)

document.addEventListener('DOMContentLoaded', () => {
    // 🔁 LOGOUT SEGURO via confirmação, se desejar usar
    const logoutLinks = document.querySelectorAll('[data-logout-confirm]');

    logoutLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const confirmMsg = link.getAttribute('data-logout-confirm') || 'Deseja realmente sair?';
            if (confirm(confirmMsg)) {
                const form = document.getElementById('logout-form');
                if (form) form.submit();
            }
        });
    });

    // 🔁 TOGGLE DE MENU (mobile, futuramente)
    const toggleBtn = document.querySelector('[data-toggle-menu]');
    const nav = document.querySelector('.uc-header__nav');

    if (toggleBtn && nav) {
        toggleBtn.addEventListener('click', () => {
            nav.classList.toggle('is-open');
        });
    }
});
