// Aguarda o DOM estar totalmente carregado
document.addEventListener("DOMContentLoaded", function () {
    // === MÁSCARAS ===
    const masks = {
        cpf: { mask: "000.000.000-00" },
        phone: { mask: "(00) 00000-0000" },
        cep: { mask: "00000-000" },
    };

    const inputs = {
        cpf: document.querySelector('input[name="cpf"]'),
        phone: document.querySelector('input[name="phone"]'),
        cep: document.querySelector('input[name="cep"]'),
    };

    for (const key in inputs) {
        if (inputs[key]) {
            IMask(inputs[key], masks[key]);
        }
    }

    // === TOGGLE DETALHES ===
    window.toggleDetails = function (id) {
        const row = document.getElementById("details-" + id);
        if (row) {
            row.style.display = row.style.display === "none" ? "" : "none";
        }
    };

    // === VIA CEP ===
    const cepInput = document.querySelector('input[name="cep"]');

    const fields = {
        state: document.querySelector('input[name="state"]'),
        city: document.querySelector('input[name="city"]'),
        bairro: document.querySelector('input[name="bairro"]'),
        street: document.querySelector('input[name="street"]'),
        latitude: document.querySelector('input[name="latitude"]'),
        longitude: document.querySelector('input[name="longitude"]'),
    };

    if (cepInput) {
        cepInput.addEventListener("blur", function () {
            const cep = this.value.replace(/\D/g, "");

            if (cep.length === 8) {
                fetch(`/api/address/search?cep=${cep}`)
                    .then((res) => {
                        if (!res.ok) throw new Error("CEP inválido");
                        return res.json();
                    })
                    .then((data) => {
                        if (data.erro || !data.cep) {
                            throw new Error("CEP não encontrado");
                        }

                        fields.state.value = data.uf || "";
                        fields.city.value = data.localidade || "";
                        fields.bairro.value = data.bairro || "";
                        fields.street.value = data.logradouro || "";
                        fields.latitude.value = data.latitude || "";
                        fields.longitude.value = data.longitude || "";
                    })
                    .catch((error) => {
                        const modal =
                            document.getElementById("modal-cep-error");
                        if (modal) modal.style.display = "block";
                    });
            }
        });
    }
});
