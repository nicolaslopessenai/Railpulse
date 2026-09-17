document.addEventListener('DOMContentLoaded', () => {
    const btnNovoSensor = document.getElementById('btn_novo_sensor');
    const btnCancelarSensor = document.getElementById('btn_cancelar_sensor');
    const sectionCadastro = document.getElementById('section_cadastro');

    if (btnNovoSensor) {
        btnNovoSensor.addEventListener('click', () => {
            sectionCadastro.style.display = 'block';
            btnNovoSensor.style.display = 'none';
        });
    }

    if (btnCancelarSensor) {
        btnCancelarSensor.addEventListener('click', () => {
            sectionCadastro.style.display = 'none';
            btnNovoSensor.style.display = 'block';
        });
    }
});
