class TableFilter {
    constructor(inputSelector, tableSelector) {
        this.input = document.querySelector(inputSelector);
        this.table = document.querySelector(tableSelector);
        this.rows = Array.from(this.table.querySelectorAll('tbody tr:not(.detail-row)'));
        this.init();
    }

    init() {
        if (!this.input || !this.table) return;

        this.input.addEventListener('input', () => {
            const query = this.input.value.toLowerCase().trim();
            let hasVisibleRows = false;

            this.rows.forEach(row => {
                if (row.classList.contains('detail-row')) return;

                const rowText = row.innerText.toLowerCase();
                const shouldShow = query === '' || rowText.includes(query);
                
                row.style.display = shouldShow ? '' : 'none';
                
                // Esconde detalhes se a linha principal estiver escondida
                const id = row.getAttribute('data-id');
                if (id) {
                    const detailRow = document.getElementById(`details-${id}`);
                    if (detailRow) {
                        detailRow.style.display = 'none';
                    }
                }

                if (shouldShow) hasVisibleRows = true;
            });

            this.toggleEmptyMessage(hasVisibleRows);
        });
    }

    toggleEmptyMessage(hasVisibleRows) {
        const tbody = this.table.querySelector('tbody');
        let emptyRow = this.table.querySelector('.empty-message');

        if (!hasVisibleRows) {
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.className = 'empty-message';
                emptyRow.innerHTML = `<td colspan="${this.table.querySelectorAll('thead th').length}">
                    Nenhum registro encontrado.
                </td>`;
                tbody.appendChild(emptyRow);
            }
        } else if (emptyRow) {
            emptyRow.remove();
        }
    }
}

// Função de toggle modificada
window.toggleDetails = function(id) {
    const row = document.getElementById(`details-${id}`);
    if (row) {
        const mainRow = document.querySelector(`tr[data-id="${id}"]`);
        if (mainRow && mainRow.style.display !== 'none') {
            row.style.display = row.style.display === 'none' ? '' : 'none';
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    new TableFilter('.fieldSearch', '#location-table');
});