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
      document.body.classList.add("modal-open");
    });
  }

  if (btn_cancelar_trem && modal_trem && form_editar) {
    btn_cancelar_trem.addEventListener("click", () => {
      modal_trem.classList.add("oculto");
      form_editar.reset();
      document.body.classList.remove("modal-open");
    });
  }

  if (tbody_trens && modal_trem && form_editar) {
    tbody_trens.addEventListener("click", (event) => {
      const btn_editar = event.target.closest(".crud_edit_button");

      if (btn_editar) {
        const edit_nome = document.getElementById("edit_nome");
        const edit_modelo = document.getElementById("edit_modelo");
        const edit_status_operacional = document.getElementById("edit_status_operacional");
        const edit_id_usuario = document.getElementById("edit_id_usuario");
        const edit_id_rota = document.getElementById("edit_id_rota");

        if (edit_original_id) edit_original_id.value = btn_editar.dataset.id || "";
        if (edit_nome) edit_nome.value = btn_editar.dataset.nome || "";
        if (edit_modelo) edit_modelo.value = btn_editar.dataset.modelo || "";
        if (edit_status_operacional) edit_status_operacional.value = btn_editar.dataset.status || "";
        if (edit_id_usuario) edit_id_usuario.value = btn_editar.dataset.usuario || "";
        if (edit_id_rota) edit_id_rota.value = btn_editar.dataset.rota || "";

        modal_trem.classList.remove("oculto");
        document.body.classList.add("modal-open");
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
        document.body.classList.remove("modal-open");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        modal_trem.classList.add("oculto");
        document.body.classList.remove("modal-open");
      }
    });
  }
});
