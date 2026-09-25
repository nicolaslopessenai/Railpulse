document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_trem = document.getElementById("btn_novo_trem");
  const btn_cancelar_trem = document.getElementById("btn_cancelar_trem");
  const modal_trem = document.getElementById("modal_trem");
  const tbody_trens = document.getElementById("tbody_trens");
  const form_editar = document.getElementById("form_editar");
  const edit_original_id = document.getElementById("edit_original_id");

  if (btn_novo_trem && modal_trem && form_editar) {
    btn_novo_trem.addEventListener("click", () => {
      form_editar.reset();
      edit_original_id.value = "";
      modal_trem.classList.remove("oculto");
    });
  }

  if (btn_cancelar_trem && modal_trem && form_editar) {
    btn_cancelar_trem.addEventListener("click", () => {
      modal_trem.classList.add("oculto");
      form_editar.reset();
    });
  }

  if (tbody_trens && modal_trem && form_editar) {
    tbody_trens.addEventListener("click", (event) => {
      const btn_editar = event.target.closest(".crud_edit_button");

      if (btn_editar) {
        edit_original_id.value = btn_editar.dataset.id;
        document.getElementById("edit_nome").value = btn_editar.dataset.nome;
        document.getElementById("edit_modelo").value = btn_editar.dataset.modelo;
        document.getElementById("edit_status_operacional").value = btn_editar.dataset.status;
        document.getElementById("edit_id_rota").value = btn_editar.dataset.rota;
        document.getElementById("edit_velocidade_atual").value = btn_editar.dataset.velocidade;
        document.getElementById("edit_latitude").value = btn_editar.dataset.latitude;
        document.getElementById("edit_longitude").value = btn_editar.dataset.longitude;
        modal_trem.classList.remove("oculto");
      }
    });

    tbody_trens.addEventListener("submit", (event) => {
      const form_excluir = event.target.closest(".crud_delete_form");
      if (form_excluir && !window.confirm(form_excluir.dataset.confirm)) {
        event.preventDefault();
      }
    });
  }

  if (modal_trem) {
    modal_trem.addEventListener("click", (event) => {
      if (event.target === modal_trem) {
        modal_trem.classList.add("oculto");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        modal_trem.classList.add("oculto");
      }
    });
  }
});