document.addEventListener("DOMContentLoaded", () => {
  const btn_nova_rota = document.getElementById("btn_nova_rota");
  const btn_cancelar_rota = document.getElementById("btn_cancelar_rota");
  const section_cadastro_rota = document.getElementById("section_cadastro_rota");
  const form_rota = document.getElementById("form_rota");

  if (btn_nova_rota && section_cadastro_rota && form_rota) {
    btn_nova_rota.addEventListener("click", () => {
      form_rota.reset();
      section_cadastro_rota.classList.remove("oculto");
      btn_nova_rota.classList.add("oculto");
    });
  }

  if (btn_cancelar_rota && section_cadastro_rota && form_rota && btn_nova_rota) {
    btn_cancelar_rota.addEventListener("click", () => {
      section_cadastro_rota.classList.add("oculto");
      form_rota.reset();
      btn_nova_rota.classList.remove("oculto");
    });
  }
});
