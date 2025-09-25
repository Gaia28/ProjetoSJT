document.addEventListener("DOMContentLoaded", () => {
  const safe = id => document.getElementById(id);

  // helper para ligar abrir/fechar modal por IDs
  function wireModal(openBtnId, modalId) {
    const openBtn = safe(openBtnId);
    const modal = safe(modalId);
    const closeBtn = modal ? modal.querySelector(".fecharModal") : null;

    if (openBtn && modal) {
      openBtn.addEventListener("click", () => modal.showModal());
    }
    if (closeBtn && modal) {
      closeBtn.addEventListener("click", () => modal.close());
    }
  }

  // === wire básicos (ajuste conforme IDs que você tem nas views) ===
  wireModal("adicionarEvento", "modalAdicionarEvento");       // calendário
  wireModal("adicionarSacramento", "modalSacramento");        // sacramentos (admin)
  wireModal("adicionarPastoral", "modalAdicionarPastoral");   // pastorais (admin)

  // Se houver modais de edição com esses ids, ligar também
  // (fechar botão)
  const modalEditarEvento = safe("modalEditarEvento");
  if (modalEditarEvento) {
    const closeBtn = modalEditarEvento.querySelector(".fecharModal");
    if (closeBtn) closeBtn.addEventListener("click", () => modalEditarEvento.close());
  }
  const modalEditarSacramento = safe("modalEditarSacramento");
  if (modalEditarSacramento) {
    const closeBtn = modalEditarSacramento.querySelector(".fecharModal");
    if (closeBtn) closeBtn.addEventListener("click", () => modalEditarSacramento.close());
  }
  const modalEditarPastoral = safe("modalEditarPastoral");
  if (modalEditarPastoral) {
    const closeBtn = modalEditarPastoral.querySelector(".fecharModal");
    if (closeBtn) closeBtn.addEventListener("click", () => modalEditarPastoral.close());
  }

  // === Funções globais para adicionar campos dinâmicos (mantém seus onclick inline) ===
  // Mantemos como propriedades de window para ser compatível com os onclick existentes.
  window.countCoord = window.countCoord || 1;
  window.countEncontro = window.countEncontro || 1;

  window.adicionarCoordenador = function() {
    const div = document.getElementById("coordenadores");
    if (!div) return console.warn("Elemento #coordenadores não encontrado.");
    const idx = window.countCoord++;
    div.insertAdjacentHTML("beforeend", `
      <div class="form-group">
        <label>Coordenador:</label>
        <input type="text" name="coordenadores[${idx}][nome]" placeholder="Nome" required>
        <input type="text" name="coordenadores[${idx}][telefone]" placeholder="Telefone">
      </div>
    `);
  };

  window.adicionarEncontro = function() {
    const div = document.getElementById("encontros");
    if (!div) return console.warn("Elemento #encontros não encontrado.");
    const idx = window.countEncontro++;
    div.insertAdjacentHTML("beforeend", `
      <div class="form-group">
        <label>Dia:</label>
        <select name="encontros[${idx}][dia_semana]">
            <option value="">-- Selecione --</option>
            <option value="Domingo">Domingo</option>
            <option value="Segunda">Segunda</option>
            <option value="Terça">Terça</option>
            <option value="Quarta">Quarta</option>
            <option value="Quinta">Quinta</option>
            <option value="Sexta">Sexta</option>
            <option value="Sábado">Sábado</option>
        </select>
        <label>Horário:</label>
        <input type="time" name="encontros[${idx}][horario]">
      </div>
    `);
  };

  // === Lógica genérica para botões "Editar" e "Excluir" (se houver) ===
  document.querySelectorAll(".botaoEditar").forEach(btn => {
    btn.addEventListener("click", () => {
      const entity = btn.dataset.entity || ""; // se usar dataset, prefira "data-entity"
      // se existir modal de edição específico, preencha campos conforme atributos data-*
      if (entity === "sacramento" && modalEditarSacramento) {
        safe("editarId") && (safe("editarId").value = btn.dataset.id || "");
        safe("editarNome") && (safe("editarNome").value = btn.dataset.nome || "");
        safe("editarValor") && (safe("editarValor").value = btn.dataset.valor || "");
        safe("editarDocumentos") && (safe("editarDocumentos").value = btn.dataset.documentos || "");
        modalEditarSacramento.showModal();
        return;
      }

      if (entity === "pastoral" && modalEditarPastoral) {
        safe("editarPastoralId") && (safe("editarPastoralId").value = btn.dataset.id || "");
        safe("editarPastoralNome") && (safe("editarPastoralNome").value = btn.dataset.nome || "");
        // se quiser, parseie coordenadores/documentos do data-attribute (ex: JSON) e preencha campos aqui
        modalEditarPastoral.showModal();
        return;
      }

      if (entity === "evento" && modalEditarEvento) {
        // preencher campos do evento a partir do dataset ou do card (fallback)
        const card = btn.closest(".card");
        safe("editar_id") && (safe("editar_id").value = btn.dataset.id || "");
        if (btn.dataset.titulo) {
          safe("editar_titulo") && (safe("editar_titulo").value = btn.dataset.titulo || "");
          safe("editar_tipo") && (safe("editar_tipo").value = btn.dataset.tipo || "");
          safe("editar_dia") && (safe("editar_dia").value = btn.dataset.dia || "");
          safe("editar_hora") && (safe("editar_hora").value = btn.dataset.hora || "");
        } else if (card) {
          safe("editar_titulo") && (safe("editar_titulo").value = (card.querySelector(".titulo")?.textContent || "").trim());
          safe("editar_tipo") && (safe("editar_tipo").value = (card.querySelector(".tipo")?.textContent || "").trim());
          safe("editar_dia") && (safe("editar_dia").value = (card.querySelector(".dia")?.textContent || "").replace("Dia da semana: ", "").trim());
          safe("editar_hora") && (safe("editar_hora").value = (card.querySelector(".hora")?.textContent || "").replace("Horário: ", "").trim());
        }
        modalEditarEvento.showModal();
      }
    });
  });

  // excluir (mantém seu padrão de fetch: devolve json { success: true/false })
  document.querySelectorAll(".botaoExcluir").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      const entity = btn.dataset.entity || "evento";
      if (!confirm("Tem certeza que deseja excluir?")) return;

      const url = (entity === "sacramento") ? "deletarSacramento" :
                  (entity === "pastoral") ? "deletarPastoral" : "excluirProgramacao";

      fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id)
      })
      .then(r => {
        // tente parsear json; backend deve retornar JSON
        return r.json().catch(() => ({ success: false, message: "Resposta inválida do servidor" }));
      })
      .then(data => {
        if (data.success) {
          btn.closest(".card")?.remove();
        } else {
          alert("Erro ao excluir: " + (data.message || "Verifique o servidor"));
        }
      })
      .catch(err => {
        console.error(err);
        alert("Erro na requisição. Veja console.");
      });
    });
  });

}); // DOMContentLoaded
