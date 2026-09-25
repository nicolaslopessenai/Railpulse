document.addEventListener("DOMContentLoaded", () => {
  const btn_nova_rota = document.getElementById("btn_nova_rota");
  const btn_cancelar_rota = document.getElementById("btn_cancelar_rota");
  const modal_rota = document.getElementById("modal_rota");
  const tbody_rotas = document.getElementById("tbody_rotas");
  const form_rota = document.getElementById("form_rota");
  const edit_original_id = document.getElementById("edit_original_id");

  if (btn_nova_rota && modal_rota && form_rota) {
    btn_nova_rota.addEventListener("click", () => {
      form_rota.reset();
      edit_original_id.value = "";
      modal_rota.classList.remove("oculto");
    });
  }

  if (btn_cancelar_rota && modal_rota && form_rota) {
    btn_cancelar_rota.addEventListener("click", () => {
      modal_rota.classList.add("oculto");
      form_rota.reset();
    });
  }

  if (tbody_rotas && modal_rota && form_rota) {
    tbody_rotas.addEventListener("click", (event) => {
      const btn_editar = event.target.closest(".crud_edit_button");
      if (btn_editar) {
        edit_original_id.value = btn_editar.dataset.id;
        document.getElementById("rota_nome").value = btn_editar.dataset.nome;
        document.getElementById("rota_origem").value = btn_editar.dataset.origem;
        document.getElementById("rota_destino").value = btn_editar.dataset.destino;
        document.getElementById("rota_distancia_km").value = btn_editar.dataset.distancia;
        modal_rota.classList.remove("oculto");
      }
    });

    tbody_rotas.addEventListener("submit", (event) => {
      const form_excluir = event.target.closest(".crud_delete_form");
      if (form_excluir && !window.confirm(form_excluir.dataset.confirm)) {
        event.preventDefault();
      }
    });
  }

  if (modal_rota) {
    modal_rota.addEventListener("click", (event) => {
      if (event.target === modal_rota) {
        modal_rota.classList.add("oculto");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        modal_rota.classList.add("oculto");
      }
    });
  }
});
