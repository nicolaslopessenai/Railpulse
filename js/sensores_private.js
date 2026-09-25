document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_sensor = document.getElementById("btn_novo_sensor");
  const btn_cancelar_sensor = document.getElementById("btn_cancelar_sensor");
  const modal_sensor = document.getElementById("modal_sensor");
  const tbody_sensores = document.getElementById("tbody_sensores");
  const form_sensor = document.getElementById("form_sensor");
  const snr_id_sensor = document.getElementById("snr_id_sensor");

  if (btn_novo_sensor && modal_sensor && form_sensor) {
    btn_novo_sensor.addEventListener("click", () => {
      form_sensor.reset();
      snr_id_sensor.value = "";
      modal_sensor.classList.remove("oculto");
    });
  }

  if (btn_cancelar_sensor && modal_sensor && form_sensor) {
    btn_cancelar_sensor.addEventListener("click", () => {
      modal_sensor.classList.add("oculto");
      form_sensor.reset();
    });
  }

  if (tbody_sensores && modal_sensor && form_sensor) {
    tbody_sensores.addEventListener("click", (event) => {
      const btn_editar = event.target.closest(".crud_edit_button");
      if (btn_editar) {
        snr_id_sensor.value = btn_editar.dataset.id;
        document.getElementById("snr_nome").value = btn_editar.dataset.nome;
        document.getElementById("snr_tipo").value = btn_editar.dataset.tipo;
        document.getElementById("snr_localizacao").value = btn_editar.dataset.localizacao;
        document.getElementById("snr_status").value = btn_editar.dataset.status;
        document.getElementById("snr_descricao").value = btn_editar.dataset.descricao;
        document.getElementById("snr_id_trem").value = btn_editar.dataset.trem;
        document.getElementById("snr_id_rota").value = btn_editar.dataset.rota;
        modal_sensor.classList.remove("oculto");
      }
    });

    tbody_sensores.addEventListener("submit", (event) => {
      const form_excluir = event.target.closest(".crud_delete_form");
      if (form_excluir && !window.confirm(form_excluir.dataset.confirm)) {
        event.preventDefault();
      }
    });
  }

  if (modal_sensor) {
    modal_sensor.addEventListener("click", (event) => {
      if (event.target === modal_sensor) {
        modal_sensor.classList.add("oculto");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        modal_sensor.classList.add("oculto");
      }
    });
  }
});
