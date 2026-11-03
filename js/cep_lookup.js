document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll("[data-cep-form]");

  forms.forEach((form) => {
    const cepInput = form.querySelector("[data-cep-input]");
    const consultaButton = form.querySelector("[data-consultar-cep]");
    const statusEl = form.querySelector("[data-cep-status]");
    const fieldsMap = {
      cep: form.querySelector('[data-endereco-field="cep"]'),
      logradouro: form.querySelector('[data-endereco-field="logradouro"]'),
      bairro: form.querySelector('[data-endereco-field="bairro"]'),
      cidade: form.querySelector('[data-endereco-field="cidade"]'),
      uf: form.querySelector('[data-endereco-field="uf"]'),
    };

    if (!cepInput || !consultaButton) {
      return;
    }

    const limparMensagem = () => {
      if (statusEl) {
        statusEl.textContent = "";
        statusEl.className = "form-text";
      }
    };

    const setMensagem = (mensagem, tipo = "info") => {
      if (!statusEl) return;
      statusEl.textContent = mensagem;
      statusEl.className = `form-text text-${tipo}`;
    };

    const limparCampos = () => {
      Object.values(fieldsMap).forEach((campo) => {
        if (campo) {
          campo.value = "";
        }
      });
    };

    const preencherCampos = (endereco) => {
      if (fieldsMap.cep) {
        fieldsMap.cep.value = endereco.cep || "";
      }
      if (fieldsMap.logradouro) {
        fieldsMap.logradouro.value = endereco.logradouro || "";
      }
      if (fieldsMap.bairro) {
        fieldsMap.bairro.value = endereco.bairro || "";
      }
      if (fieldsMap.cidade) {
        fieldsMap.cidade.value = endereco.localidade || "";
      }
      if (fieldsMap.uf) {
        fieldsMap.uf.value = endereco.uf || "";
      }
    };

    consultaButton.addEventListener("click", async (event) => {
      event.preventDefault();
      limparMensagem();

      const cep = (cepInput.value || "").replace(/\D/g, "");
      if (!/^\d{8}$/.test(cep)) {
        limparCampos();
        setMensagem("Informe um CEP com 8 dígitos numéricos.", "danger");
        cepInput.focus();
        return;
      }

      consultaButton.disabled = true;
      consultaButton.textContent = "Consultando...";

      try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        if (!response.ok) {
          throw new Error("Erro de comunicação com a API ViaCEP.");
        }

        const endereco = await response.json();
        if (endereco.erro) {
          limparCampos();
          setMensagem(
            "CEP não encontrado. Verifique o valor informado.",
            "warning",
          );
          return;
        }

        cepInput.value = cep.replace(/(\d{5})(\d{3})/, "$1-$2");
        preencherCampos(endereco);
        setMensagem("CEP localizado com sucesso.", "success");
      } catch (error) {
        console.error("Erro ao consultar CEP:", error);
        limparCampos();
        setMensagem(
          "Não foi possível consultar o CEP no momento. Tente novamente mais tarde.",
          "danger",
        );
      } finally {
        consultaButton.disabled = false;
        consultaButton.textContent = "Buscar";
      }
    });
  });
});
