document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_usuario = document.getElementById("btn_novo_usuario");
  const btn_cancelar_usuario = document.getElementById("btn_cancelar_usuario");
  const modal_usuario = document.getElementById("modal_usuario");
  const tabela_usuarios = document.getElementById("tabela_usuarios");
  const form_usuario = document.getElementById("form_usuario");
  const usr_id = document.getElementById("usr_id");
  const cad_senha = document.getElementById("cad_senha");

  if (btn_novo_usuario && modal_usuario && form_usuario) {
    btn_novo_usuario.addEventListener("click", () => {
      form_usuario.reset();
      usr_id.value = "";
      cad_senha.required = true;
      modal_usuario.classList.remove("oculto");
    });
  }

  if (btn_cancelar_usuario && modal_usuario && form_usuario) {
    btn_cancelar_usuario.addEventListener("click", () => {
      modal_usuario.classList.add("oculto");
      form_usuario.reset();
      cad_senha.required = false;
    });
  }

  if (tabela_usuarios && modal_usuario && form_usuario) {
    tabela_usuarios.addEventListener("click", (event) => {
      const btn_editar = event.target.closest(".crud_edit_button");
      if (btn_editar) {
        form_usuario.reset();
        usr_id.value = btn_editar.dataset.id;
        document.getElementById("cad_nome").value = btn_editar.dataset.nome;
        document.getElementById("cad_email").value = btn_editar.dataset.email;
        document.getElementById("cad_matricula").value = btn_editar.dataset.matricula;
        document.getElementById("cad_cargo").value = btn_editar.dataset.cargo;
        cad_senha.required = false;
        modal_usuario.classList.remove("oculto");
      }
    });

    tabela_usuarios.addEventListener("submit", (event) => {
      const form_excluir = event.target.closest(".crud_delete_form");
      if (form_excluir && !window.confirm(form_excluir.dataset.confirm)) {
        event.preventDefault();
      }
    });
  }

  if (modal_usuario) {
    modal_usuario.addEventListener("click", (event) => {
      if (event.target === modal_usuario) {
        modal_usuario.classList.add("oculto");
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
        modal_usuario.classList.add("oculto");
      }
    });
  }
});