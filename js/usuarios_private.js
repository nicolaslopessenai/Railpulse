document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_usuario = document.getElementById("btn_novo_usuario");
  const btn_cancelar_usuario = document.getElementById("btn_cancelar_usuario");
  const section_cadastro_usuario = document.getElementById("section_cadastro_usuario");
  const form_usuario = document.getElementById("form_usuario");

  if (btn_novo_usuario && section_cadastro_usuario) {
    btn_novo_usuario.addEventListener("click", () => {
      section_cadastro_usuario.classList.remove("oculto");
      btn_novo_usuario.classList.add("oculto");
    });
  }

  if (btn_cancelar_usuario && section_cadastro_usuario && form_usuario && btn_novo_usuario) {
    btn_cancelar_usuario.addEventListener("click", () => {
      section_cadastro_usuario.classList.add("oculto");
      form_usuario.reset();
      btn_novo_usuario.classList.remove("oculto");
    });
  }
});