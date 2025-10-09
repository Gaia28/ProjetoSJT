document.addEventListener("DOMContentLoaded", () => {
  const safe = id => document.getElementById(id);

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

  wireModal("adicionarEvento", "modalAdicionarEvento");
  wireModal("adicionarSacramento", "modalSacramento");
  wireModal("adicionarPastoral", "modalAdicionarPastoral");

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

  let coordCount = 1; 

  window.adicionarCoordenador = function(containerId) {
    const div = document.getElementById(containerId);
    if (!div) return;
    
    const index = coordCount++;
    div.insertAdjacentHTML("beforeend", `
      <div class="form-group" id="coord-group-${index}">
        <label>Coordenador:</label>
        <input type="text" name="coordenadores[${index}][nome]" placeholder="Nome" required>
        <input type="text" name="coordenadores[${index}][telefone]" placeholder="Telefone">
        <button type="button" class="botao-remover" onclick="document.getElementById('coord-group-${index}').remove()">X</button>
      </div>
    `);
  };

  document.querySelectorAll(".botaoEditar").forEach(btn => {
    btn.addEventListener("click", async () => {
      const entity = btn.dataset.entity || "";
      const id = btn.dataset.id || "";

      // ===============================================================
      // CORREÇÃO: LÓGICA PARA SACRAMENTOS QUE ESTAVA FALTANDO
      // ===============================================================
      if (entity === "sacramento" && modalEditarSacramento) {
        safe("editarId").value = btn.dataset.id || "";
        safe("editarNome").value = btn.dataset.nome || "";
        safe("editarValor").value = btn.dataset.valor || "";
        safe("editarDocumentos").value = btn.dataset.documentos || "";
        modalEditarSacramento.showModal();
        return; // Importante para parar a execução aqui
      }

      // LÓGICA PARA PASTORAIS (com AJAX)
      if (entity === "pastoral" && modalEditarPastoral && id) {
        try {
          const response = await fetch(`getPastoralDetails?id=${id}`);
          if (!response.ok) throw new Error('Erro na rede');
          
          const data = await response.json();
          if (data.error) throw new Error(data.error);

          safe("editarPastoralId").value = data.id;
          safe("editarPastoralNome").value = data.nome;

          const container = safe("coordenadoresEditar");
          container.innerHTML = ''; 
          
          if (data.coordenadores && data.coordenadores.length > 0) {
            data.coordenadores.forEach(coord => {
              const index = coordCount++;
              container.insertAdjacentHTML("beforeend", `
                <div class="form-group" id="coord-group-${index}">
                  <label>Coordenador:</label>
                  <input type="text" name="coordenadores[${index}][nome]" value="${coord.nome}" placeholder="Nome" required>
                  <input type="text" name="coordenadores[${index}][telefone]" value="${coord.telefone}" placeholder="Telefone">
                  <button type="button" class="botao-remover" onclick="document.getElementById('coord-group-${index}').remove()">X</button>
                </div>
              `);
            });
          }
          modalEditarPastoral.showModal();

        } catch (error) {
          console.error("Erro ao buscar detalhes da pastoral:", error);
          alert("Não foi possível carregar os dados para edição.");
        }
        return;
      }
      
      // LÓGICA PARA EVENTOS
      if (entity === "evento" && modalEditarEvento) {
        safe("editar_id").value = btn.dataset.id || "";
        safe("editar_titulo").value = btn.dataset.titulo || "";
        safe("editar_tipo").value = btn.dataset.tipo || "";
        safe("editar_dia").value = btn.dataset.dia || "";
        safe("editar_hora").value = btn.dataset.hora || "";
        modalEditarEvento.showModal();
      }
    });
  });
  if (entity === "eventoAdmin" && modalEditarEventoAdmin) {
          modalEditarEventoAdmin.querySelector('#editar_id').value = btn.dataset.id || '';
          modalEditarEventoAdmin.querySelector('#editar_nome').value = btn.dataset.nome || '';
          modalEditarEventoAdmin.querySelector('#editar_data').value = btn.dataset.data_evento || '';
          modalEditarEventoAdmin.querySelector('#editar_horario').value = btn.dataset.horario || '';
          modalEditarEventoAdmin.querySelector('#editar_local').value = btn.dataset.local || '';
          modalEditarEventoAdmin.querySelector('#editar_descricao').value = btn.dataset.descricao || '';
          
          modalEditarEventoAdmin.querySelector('#editar_imagem').value = '';
          const preview = modalEditarEventoAdmin.querySelector('#imagemPreviewEditar');
          if (preview) {
              preview.style.display = 'none';
              preview.setAttribute('src', '#');
          }

          modalEditarEventoAdmin.showModal();
          return;
      }
    });

  document.querySelectorAll(".botaoExcluir").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      const entity = btn.dataset.entity || "evento";
      if (!confirm("Tem certeza que deseja excluir?")) return;

      const url = {
        sacramento: "deletarSacramento",
        pastoral: "deletarPastoral",
        evento: "excluirProgramacao"
      }[entity] || "excluirProgramacao";

      fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id)
      })
      .then(r => r.json().catch(() => ({ success: false, message: "Resposta inválida" })))
      .then(data => {
        if (data.success) {
          btn.closest(".card")?.remove();
        } else {
          alert("Erro ao excluir: " + (data.message || "Tente novamente"));
        }
      })
      .catch(err => alert("Erro na requisição. Veja o console."));
    });
  });
