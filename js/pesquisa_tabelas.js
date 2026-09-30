document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.querySelector(".tbody-busca-universal");
    if (!tbody) return;

    const container = tbody.closest(".card-body") || document;
    const inputBusca = container.querySelector(".form-control");
    if (!inputBusca) return;

    function filtrarTabela() {
        const termo = inputBusca.value.toLowerCase().trim();
        const tabelaRows = tbody.querySelectorAll("tr");

        tabelaRows.forEach(row => {
            if (row.cells.length === 1) return;

            const textoDaLinha = row.innerText.toLowerCase();

            if (textoDaLinha.includes(termo)) {
                row.style.display = ""; 
            } else {
                row.style.display = "none"; 
            }
        });
    }

    inputBusca.addEventListener("input", filtrarTabela);

    const formPai = inputBusca.closest("form");
    if (formPai) {
        formPai.addEventListener("submit", function (e) {
            e.preventDefault();
            filtrarTabela();
        });
    }
});
