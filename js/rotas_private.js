document.addEventListener("DOMContentLoaded", () => {
  const btn_nova_rota = document.getElementById("btn_nova_rota");
  const btn_cancelar_rota = document.getElementById("btn_cancelar_rota");
  const modal_rota = document.getElementById("modal_rota");
  const tbody_rotas = document.getElementById("tbody_rotas");
  const form_rota = document.getElementById("form_rota");
  const edit_original_id = document.getElementById("edit_original_id");
  const rota_trem_select = document.getElementById("rota_trem_select");
  const rota_origem = document.getElementById("rota_origem");
  const rota_destino = document.getElementById("rota_destino");

  const btn_novo_endereco = document.getElementById("btn_novo_endereco");
  const btn_fechar_endereco = document.getElementById("btn_fechar_endereco");
  const btn_salvar_endereco = document.getElementById("btn_salvar_endereco");
  const modal_endereco = document.getElementById("modal_endereco");
  const lista_enderecos = document.getElementById("lista_enderecos");
  const selects_endereco = document.querySelectorAll(".select_endereco");

  const modal_detalhe_rota = document.getElementById("modal_detalhe_rota");
  const btn_fechar_detalhe = document.getElementById("btn_fechar_detalhe");

  const CHAVE_ENDERECOS = "railpulse_enderecos";

  const ler_enderecos = () => {
    try {
      return JSON.parse(localStorage.getItem(CHAVE_ENDERECOS)) || [];
    } catch (erro) {
      return [];
    }
  };

  const gravar_enderecos = (enderecos) => {
    localStorage.setItem(CHAVE_ENDERECOS, JSON.stringify(enderecos));
  };

  const fechar_modal = (modal) => {
    modal.classList.add("oculto");
    document.body.classList.remove("modal-open");
  };

  const abrir_modal = (modal) => {
    modal.classList.remove("oculto");
    document.body.classList.add("modal-open");
  };

  const atualizar_enderecos = () => {
    const enderecos = ler_enderecos();

    selects_endereco.forEach((select) => {
      const texto_vazio =
        enderecos.length === 0
          ? "Nenhum endereço salvo - use + Adicionar endereço"
          : "Selecione um endereço salvo";
      select.innerHTML = "";

      const opcao_vazia = document.createElement("option");
      opcao_vazia.value = "";
      opcao_vazia.textContent = texto_vazio;
      select.appendChild(opcao_vazia);

      enderecos.forEach((endereco) => {
        const opcao = document.createElement("option");
        opcao.value = endereco;
        opcao.textContent = endereco;
        select.appendChild(opcao);
      });
    });

    if (!lista_enderecos) return;
    lista_enderecos.innerHTML = "";
    if (enderecos.length === 0) {
      lista_enderecos.innerHTML =
        '<li class="list-group-item text-secondary small">Nenhum endereço salvo ainda.</li>';
    }
    enderecos.forEach((endereco, indice) => {
      const item = document.createElement("li");
      item.className =
        "list-group-item d-flex justify-content-between align-items-center gap-2";

      const texto = document.createElement("span");
      texto.textContent = endereco;

      const btn_remover = document.createElement("button");
      btn_remover.type = "button";
      btn_remover.className = "btn btn-outline-danger btn-sm";
      btn_remover.textContent = "Remover";
      btn_remover.dataset.indice = indice;

      item.appendChild(texto);
      item.appendChild(btn_remover);
      lista_enderecos.appendChild(item);
    });
  };

  const escolher_endereco = (select, valor) => {
    const existe = Array.from(select.options).some(
      (opcao) => opcao.value === valor,
    );
    if (!existe && valor !== "") {
      const opcao = document.createElement("option");
      opcao.value = valor;
      opcao.textContent = valor;
      select.appendChild(opcao);
    }
    select.value = valor;
  };

  if (btn_novo_endereco && modal_endereco) {
    btn_novo_endereco.addEventListener("click", () => {
      modal_endereco
        .querySelectorAll("input")
        .forEach((campo) => (campo.value = ""));
      modal_endereco.querySelector("[data-cep-status]").textContent = "";
      atualizar_enderecos();
      abrir_modal(modal_endereco);
    });
  }

  if (btn_fechar_endereco && modal_endereco) {
    btn_fechar_endereco.addEventListener("click", () => {
      fechar_modal(modal_endereco);
    });
  }

  if (btn_salvar_endereco) {
    btn_salvar_endereco.addEventListener("click", () => {
      const cep = document.getElementById("end_cep").value;
      const logradouro = document.getElementById("end_logradouro").value;
      const bairro = document.getElementById("end_bairro").value;
      const cidade = document.getElementById("end_cidade").value;
      const uf = document.getElementById("end_uf").value;
      const status = modal_endereco.querySelector("[data-cep-status]");

      if (cidade === "") {
        status.textContent = "Busque um CEP válido antes de salvar.";
        status.className = "form-text mb-2 text-danger";
        return;
      }

      const partes = [logradouro, bairro].filter((parte) => parte !== "");
      const endereco = (
        partes.join(", ") +
        (partes.length ? ", " : "") +
        cidade +
        " - " +
        uf +
        " (" +
        cep +
        ")"
      ).slice(0, 150);

      const enderecos = ler_enderecos();
      if (!enderecos.includes(endereco)) {
        enderecos.push(endereco);
        gravar_enderecos(enderecos);
      }

      modal_endereco
        .querySelectorAll("input")
        .forEach((campo) => (campo.value = ""));
      status.textContent = "Endereço salvo.";
      status.className = "form-text mb-2 text-success";
      atualizar_enderecos();
    });
  }

  if (lista_enderecos) {
    lista_enderecos.addEventListener("click", (event) => {
      const btn_remover = event.target.closest("button[data-indice]");
      if (!btn_remover) return;

      if (!window.confirm("Tem certeza que deseja excluir este endereço?")) {
        return;
      }

      const enderecos = ler_enderecos();
      enderecos.splice(Number(btn_remover.dataset.indice), 1);
      gravar_enderecos(enderecos);
      atualizar_enderecos();
    });
  }

  atualizar_enderecos();

  if (btn_nova_rota && modal_rota && form_rota) {
    btn_nova_rota.addEventListener("click", () => {
      atualizar_enderecos();
      form_rota.reset();
      erro_rota.classList.add("oculto");
      edit_original_id.value = "";
      if (rota_trem_select) rota_trem_select.value = "";
      abrir_modal(modal_rota);
    });
  }

  if (btn_cancelar_rota && modal_rota && form_rota) {
    btn_cancelar_rota.addEventListener("click", () => {
      fechar_modal(modal_rota);
      form_rota.reset();
      if (rota_trem_select) rota_trem_select.value = "";
    });
  }

  if (tbody_rotas && modal_rota && form_rota) {
    tbody_rotas.addEventListener("click", (event) => {
      const link_rota = event.target.closest(".link_rota");
      if (link_rota && modal_detalhe_rota) {
        event.preventDefault();
        document.getElementById("detalhe_nome").textContent =
          link_rota.dataset.nome;
        document.getElementById("detalhe_origem").textContent =
          link_rota.dataset.origem;
        document.getElementById("detalhe_destino").textContent =
          link_rota.dataset.destino;
        document.getElementById("detalhe_distancia").textContent =
          link_rota.dataset.distancia + " km";
        abrir_modal(modal_detalhe_rota);
        return;
      }

      const btn_editar = event.target.closest(".crud_edit_button");
      if (btn_editar) {
        atualizar_enderecos();
        form_rota.reset();
        erro_rota.classList.add("oculto");
        edit_original_id.value = btn_editar.dataset.id;
        document.getElementById("rota_nome").value = btn_editar.dataset.nome;
        escolher_endereco(rota_origem, btn_editar.dataset.origem);
        escolher_endereco(rota_destino, btn_editar.dataset.destino);
        document.getElementById("rota_distancia_km").value =
          btn_editar.dataset.distancia;
        abrir_modal(modal_rota);
      }
    });
  }

  const erro_rota = document.getElementById("erro_rota");

  if (form_rota) {
    form_rota.addEventListener("submit", (event) => {
      if (rota_origem.value === rota_destino.value) {
        event.preventDefault();
        erro_rota.classList.remove("oculto");
      }
    });

    [rota_origem, rota_destino].forEach((select) => {
      select.addEventListener("change", () => {
        erro_rota.classList.add("oculto");
      });
    });
  }

  if (btn_fechar_detalhe && modal_detalhe_rota) {
    btn_fechar_detalhe.addEventListener("click", () => {
      fechar_modal(modal_detalhe_rota);
    });
  }

  [modal_rota, modal_endereco, modal_detalhe_rota].forEach((modal) => {
    if (!modal) return;
    modal.addEventListener("click", (event) => {
      if (event.target === modal) {
        fechar_modal(modal);
      }
    });
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      [modal_rota, modal_endereco, modal_detalhe_rota].forEach((modal) => {
        if (modal) fechar_modal(modal);
      });
    }
  });
});
