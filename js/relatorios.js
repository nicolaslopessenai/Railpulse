document.addEventListener("DOMContentLoaded", () => {
  const STORAGE_KEY = "railpulse_relatorios_gerados";
  const inputBusca = document.getElementById("input_busca");
  const msgBuscaVazia = document.getElementById("msg_busca_vazia");
  const listaRelatorios = document.getElementById("lista_relatorios");
  const listaRelatoriosVazia = document.getElementById("lista_relatorios_vazia");
  const botaoLimparHistorico = document.getElementById("btn_limpar_historico");

  const carregarHistorico = () => {
    try {
      const dados = localStorage.getItem(STORAGE_KEY);
      return dados ? JSON.parse(dados) : [];
    } catch (erro) {
      console.warn("Não foi possível ler o histórico de relatórios:", erro);
      return [];
    }
  };

  const salvarHistorico = (historico) => {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(historico));
    } catch (erro) {
      console.warn("Não foi possível salvar o histórico de relatórios:", erro);
    }
  };

  const formatarData = (valor) => {
    if (!valor) {
      return "Data indisponível";
    }

    return new Date(valor).toLocaleString("pt-BR", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    });
  };

  const baixarPdfDoHistorico = (item) => {
    if (!item?.pdfBase64) {
      return;
    }

    const bytes = atob(item.pdfBase64);
    const binario = new Uint8Array(bytes.length);

    for (let indice = 0; indice < bytes.length; indice += 1) {
      binario[indice] = bytes.charCodeAt(indice);
    }

    const blob = new Blob([binario], { type: "application/pdf" });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.href = url;
    link.download = item.fileName;
    document.body.appendChild(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(url);
  };

  const renderizarHistorico = () => {
    if (!listaRelatorios) {
      return;
    }

    const historico = carregarHistorico();
    listaRelatorios.innerHTML = "";

    if (!historico.length) {
      if (listaRelatoriosVazia) {
        listaRelatoriosVazia.classList.remove("d-none");
      }
      return;
    }

    if (listaRelatoriosVazia) {
      listaRelatoriosVazia.classList.add("d-none");
    }

    historico.forEach((item) => {
      const linha = document.createElement("li");
      linha.className = "relatorio-item list-group-item d-flex justify-content-between align-items-center gap-3";
      linha.title = item.fileName;

      const info = document.createElement("div");
      info.innerHTML = `
        <div class="fw-semibold">${item.fileName}</div>
        <small class="text-secondary">Gerado em ${formatarData(item.createdAt)}</small>
      `;

      const botao = document.createElement("button");
      botao.type = "button";
      botao.className = "btn btn-sm btn-outline-primary";
      botao.textContent = "Baixar";
      botao.addEventListener("click", () => baixarPdfDoHistorico(item));

      linha.appendChild(info);
      linha.appendChild(botao);
      listaRelatorios.appendChild(linha);
    });
  };

  if (botaoLimparHistorico) {
    botaoLimparHistorico.addEventListener("click", () => {
      localStorage.removeItem(STORAGE_KEY);
      renderizarHistorico();
    });
  }

  if (inputBusca && listaRelatorios) {
    const aplicarFiltro = () => {
      const termo = inputBusca.value.trim().toLowerCase();
      const itens = listaRelatorios.querySelectorAll(".relatorio-item");
      let encontrado = false;

      itens.forEach((item) => {
        const texto = (item.textContent || "").toLowerCase();
        const visivel = !termo || texto.includes(termo);

        item.classList.toggle("d-none", !visivel);

        if (visivel) {
          encontrado = true;
        }
      });

      if (msgBuscaVazia) {
        msgBuscaVazia.classList.toggle("oculto", encontrado || !termo);
      }
    };

    inputBusca.addEventListener("input", aplicarFiltro);
    aplicarFiltro();
  }

  renderizarHistorico();

  const botaoPdf = document.getElementById("btn_gerar_pdf");
  const loadingEl = document.getElementById("report_loading");
  const errorEl = document.getElementById("report_error");

  if (!botaoPdf) {
    return;
  }

  const formatarTexto = (valor) => {
    if (!valor && valor !== 0) {
      return "-";
    }

    return String(valor)
      .replace(/_/g, " ")
      .replace(/\b\w/g, (letra) => letra.toUpperCase());
  };

  const setLoading = (estaCarregando) => {
    botaoPdf.disabled = estaCarregando;
    botaoPdf.innerHTML = estaCarregando
      ? '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Gerando PDF...'
      : "Gerar PDF";

    if (loadingEl) {
      loadingEl.classList.toggle("d-none", !estaCarregando);
    }
  };

  const exibirErro = (mensagem) => {
    if (!errorEl) {
      return;
    }

    errorEl.textContent = mensagem;
    errorEl.classList.remove("d-none");
  };

  const ocultarErro = () => {
    if (!errorEl) {
      return;
    }

    errorEl.textContent = "";
    errorEl.classList.add("d-none");
  };

  const salvarRelatorioGerado = (fileName, pdfBlob) => {
    const leitor = new FileReader();

    leitor.onload = () => {
      const base64 = String(leitor.result || "").split(",")[1] || "";
      const historico = carregarHistorico();
      const novoRegistro = {
        id: Date.now(),
        fileName,
        createdAt: new Date().toISOString(),
        pdfBase64: base64,
      };

      historico.unshift(novoRegistro);
      salvarHistorico(historico.slice(0, 12));
      renderizarHistorico();
    };

    leitor.readAsDataURL(pdfBlob);
  };

  const baixarPdf = (pdfBlob, fileName) => {
    const url = URL.createObjectURL(pdfBlob);
    const link = document.createElement("a");
    link.href = url;
    link.download = fileName;
    link.style.display = "none";
    document.body.appendChild(link);
    link.click();
    link.remove();
    setTimeout(() => URL.revokeObjectURL(url), 1000);
  };

  const gerarPdfRelatorio = (itens) => {
    if (!window.jspdf || !window.jspdf.jsPDF) {
      throw new Error("A biblioteca de PDF não está disponível.");
    }

    const { jsPDF } = window.jspdf;
    const documento = new jsPDF({ unit: "pt", format: "a4" });
    const fileName = `relatorio_railpulse_${new Date().toISOString().slice(0, 19).replace(/[:T]/g, "-")}.pdf`;

    documento.setFontSize(18);
    documento.text("Relatório consolidado RailPulse", 40, 52);
    documento.setFontSize(10);
    documento.text(`Gerado em: ${new Date().toLocaleString("pt-BR")}`, 40, 72);
    documento.text(`Registros: ${itens.length}`, 40, 88);

    const linhas = itens.map((item, indice) => [
      indice + 1,
      `${item.rota_nome || "-"} (${item.origem || "-"} → ${item.destino || "-"})`,
      item.trem_nome || "-",
      item.sensor_nome || "-",
      item.responsavel_nome || "-",
      `${formatarTexto(item.trem_status)} / ${formatarTexto(item.sensor_status)}`,
      item.localizacao || "-",
    ]);

    const cabecalho = [["#", "Rota", "Trem", "Sensor", "Responsável", "Status", "Localização"]];

    if (typeof documento.autoTable === "function") {
      documento.autoTable({
        head: cabecalho,
        body: linhas,
        startY: 110,
        theme: "grid",
        headStyles: {
          fillColor: [45, 151, 212],
          textColor: [255, 255, 255],
          fontStyle: "bold",
        },
        alternateRowStyles: {
          fillColor: [248, 250, 252],
        },
        styles: {
          fontSize: 8,
          cellPadding: 6,
        },
        margin: { left: 40, right: 40 },
      });
    } else {
      let cursorY = 110;
      documento.setFontSize(9);
      documento.text("Não foi possível aplicar a tabela dinâmica. Abaixo, os dados serão listados em texto.", 40, cursorY);
      cursorY += 18;

      linhas.forEach((linha) => {
        if (cursorY > 760) {
          documento.addPage();
          cursorY = 50;
        }

        documento.text(
          `${linha[0]}. ${linha[1]} | ${linha[2]} | ${linha[3]} | ${linha[4]} | ${linha[5]} | ${linha[6]}`,
          40,
          cursorY,
          { maxWidth: 510 },
        );
        cursorY += 16;
      });
    }

    const pdfBlob = documento.output("blob");
    salvarRelatorioGerado(fileName, pdfBlob);
    baixarPdf(pdfBlob, fileName);
  };

  botaoPdf.addEventListener("click", async () => {
    ocultarErro();
    setLoading(true);

    try {
      const resposta = await fetch("../infra/relatorio_consolidado.php", {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      });

      if (!resposta.ok) {
        throw new Error("Falha ao buscar dados do relatório.");
      }

      const dados = await resposta.json();

      if (!dados.success || !Array.isArray(dados.itens) || dados.itens.length === 0) {
        throw new Error(dados.message || "Nenhum dado encontrado para gerar o PDF.");
      }

      gerarPdfRelatorio(dados.itens);
    } catch (erro) {
      console.error("Erro ao gerar relatório PDF:", erro);
      exibirErro(
        erro.message || "Não foi possível gerar o relatório no momento. Tente novamente mais tarde.",
      );
    } finally {
      setLoading(false);
    }
  });
});
