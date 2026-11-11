document.addEventListener("submit", (event) => {
  const form_excluir = event.target.closest(".crud_delete_form");
  if (!form_excluir) return;

  const detalhe = form_excluir.dataset.confirm || "";
  if (!window.confirm("Tem certeza que deseja excluir?\n\n" + detalhe)) {
    event.preventDefault();
  }
});

document.addEventListener("click", (event) => {
  const link_sair = event.target.closest('a[href$="logout.php"]');
  if (!link_sair) return;

  if (!window.confirm("Tem certeza que deseja sair?")) {
    event.preventDefault();
  }
});
