document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("input_busca");
  const tableBody = document.getElementById("tbody_rotas");
  if (!searchInput || !tableBody) return;

  const normalizeText = (value) => value
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase()
    .trim();

  searchInput.addEventListener("input", () => {
    const query = normalizeText(searchInput.value);
    const rows = Array.from(tableBody.querySelectorAll("tr:not(.linha_busca_vazia)"));
    const matchingRows = rows.filter((row) => normalizeText(row.textContent).includes(query));
    const matchingSet = new Set(matchingRows);

    rows.forEach((row) => row.classList.toggle("oculto", !matchingSet.has(row)));

    let emptyRow = tableBody.querySelector(".linha_busca_vazia");
    if (!emptyRow) {
      emptyRow = document.createElement("tr");
      emptyRow.className = "linha_busca_vazia oculto";
      const cell = document.createElement("td");
      cell.colSpan = tableBody.closest("table").querySelectorAll("thead th").length;
      cell.textContent = "Nenhum resultado encontrado.";
      emptyRow.appendChild(cell);
      tableBody.appendChild(emptyRow);
    }

    emptyRow.classList.toggle("oculto", !query || matchingRows.length > 0);
  });
});
