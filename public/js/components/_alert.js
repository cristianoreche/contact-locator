// alert.js — Alerta institucional com desaparecimento automático
document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.uc-alert');

    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';

            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 400);
        }, 5000); // 5 segundos visível
    });
});
