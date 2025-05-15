// Aguarda o carregamento completo do DOM antes de executar o script
document.addEventListener('DOMContentLoaded', function () {

    // Seleciona todos os formulários da página
    document.querySelectorAll('form').forEach(form => {

        // Para cada formulário, adiciona um listener ao evento de submissão
        form.addEventListener('submit', function () {

            // Seleciona todos os botões submit com o atributo data-loading-text
            const buttons = form.querySelectorAll('button[type="submit"][data-loading-text]');

            // Para cada botão identificado:
            buttons.forEach(button => {

                // Evita ação se o botão já estiver desabilitado
                if (!button.disabled) {

                    // Obtém o texto de carregamento definido via data-loading-text (ou usa "Aguarde..." por padrão)
                    const loadingText = button.getAttribute('data-loading-text') || 'Aguarde...';

                    // Substitui o conteúdo do botão pelo spinner + texto de carregamento
                    button.innerHTML = `
                        <i class="ri-loader-4-line uc-button__spinner" aria-hidden="true"></i>
                        <span class="button-text">${loadingText}</span>
                    `;

                    // Desabilita o botão para evitar múltiplos envios
                    button.disabled = true;
                }
            });
        });
    });
});
