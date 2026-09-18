document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_trem = document.getElementById("btn_novo_trem");
  const btn_cancelar_trem = document.getElementById("btn_cancelar_trem");
  const section_cadastro_trem = document.getElementById("section_cadastro_trem");
  const form_editar = document.getElementById("form_editar");

  if (btn_novo_trem && section_cadastro_trem && form_editar) {
    btn_novo_trem.addEventListener("click", () => {
      form_editar.reset();
      section_cadastro_trem.classList.remove("oculto");
      btn_novo_trem.classList.add("oculto");
    });
  }

  if (btn_cancelar_trem && section_cadastro_trem && form_editar && btn_novo_trem) {
    btn_cancelar_trem.addEventListener("click", () => {
      section_cadastro_trem.classList.add("oculto");
      form_editar.reset();
      btn_novo_trem.classList.remove("oculto");
    });
  }
});