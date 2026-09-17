document.addEventListener("DOMContentLoaded", () => {
  const btn_novo_sensor = document.getElementById("btn_novo_sensor");
  const btn_cancelar_sensor = document.getElementById("btn_cancelar_sensor");
  const section_cadastro = document.getElementById("section_cadastro");
  const form_sensor = document.getElementById("form_sensor");

  if (btn_novo_sensor && section_cadastro) {
    btn_novo_sensor.addEventListener("click", () => {
      section_cadastro.classList.remove("oculto");
      btn_novo_sensor.classList.add("oculto");
    });
  }

  if (btn_cancelar_sensor && section_cadastro && form_sensor && btn_novo_sensor) {
    btn_cancelar_sensor.addEventListener("click", () => {
      section_cadastro.classList.add("oculto");
      form_sensor.reset();
      btn_novo_sensor.classList.remove("oculto");
    });
  }
});
