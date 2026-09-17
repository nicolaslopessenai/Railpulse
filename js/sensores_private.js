document.addEventListener('DOMContentLoaded', () => {
    const btnNovoSensor = document.getElementById('btn_novo_sensor');
    const btnCancelarSensor = document.getElementById('btn_cancelar_sensor');
    const sectionCadastro = document.getElementById('section_cadastro');
    const formSensor = document.getElementById('form_sensor');

    if (btnNovoSensor) {
        btnNovoSensor.addEventListener('click', () => {
            sectionCadastro.style.display = 'block'; // Mostra a área de cadastro
            btnNovoSensor.style.display = 'none';    // Esconde o botão de novo sensor temporariamente
        });
    }

    if (btnCancelarSensor) {
        btnCancelarSensor.addEventListener('click', () => {
            sectionCadastro.style.display = 'none';  // Esconde a área de cadastro
            formSensor.reset();                     // Limpa todos os inputs preenchidos
            btnNovoSensor.style.display = 'block';   // Faz o botão principal aparecer de volta
        });
    }
});
