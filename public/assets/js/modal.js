document.addEventListener("DOMContentLoaded", () => {
    // ---------- Helpers ----------
    const safe = (id) => document.getElementById(id);

    // ---------- MODAL ADICIONAR / EDITAR - EVENTO ----------
    const btAdicionarEvento = safe("adicionarEvento");
    const modalAdicionarEvento = safe("modalAdicionarEvento");
    const btFecharAdicionarEvento = modalAdicionarEvento ? modalAdicionarEvento.querySelector(".fecharModal") : null;

    if (btAdicionarEvento && modalAdicionarEvento) {
        btAdicionarEvento.addEventListener("click", () => modalAdicionarEvento.showModal());
    }
    if (btFecharAdicionarEvento && modalAdicionarEvento) {
        btFecharAdicionarEvento.addEventListener("click", () => modalAdicionarEvento.close());
    }

    const modalEditarEvento = safe("modalEditarEvento");
    const btFecharModalEditarEvento = modalEditarEvento ? modalEditarEvento.querySelector(".fecharModal") : null;

    // ---------- MODAL ADICIONAR / EDITAR - SACRAMENTO ----------
    const btAdicionarSacramento = safe("adicionarSacramento");
    const modalSacramento = safe("modalSacramento");
    const btFecharSacramento = modalSacramento ? modalSacramento.querySelector(".fecharModal") : null;

    if (btAdicionarSacramento && modalSacramento) {
        btAdicionarSacramento.addEventListener("click", () => modalSacramento.showModal());
    }
    if (btFecharSacramento && modalSacramento) {
        btFecharSacramento.addEventListener("click", () => modalSacramento.close());
    }

    const modalEditarSacramento = safe("modalEditarSacramento");
    const btFecharModalEditarSacramento = modalEditarSacramento ? modalEditarSacramento.querySelector(".fecharModal") : null;
    if (btFecharModalEditarSacramento && modalEditarSacramento) {
        btFecharModalEditarSacramento.addEventListener("click", () => modalEditarSacramento.close());
    }

    // ---------- BOTÕES EDITAR (GENÉRICO) ----------
    // Seleciona todos os botões de editar (eventos e sacramentos)
    document.querySelectorAll(".botaoEditar").forEach(btn => {
        btn.addEventListener("click", () => {
            const entity = btn.dataset.entity || "evento"; // se quiser padronizar: evento / sacramento
            const id = btn.dataset.id;

            if (entity === "sacramento" && modalEditarSacramento) {
                // preenche campos do modal de sacramento (ids: editarId, editarNome, editarTipo, editarValor, editarDocumentos)
                safe("editarId") && (safe("editarId").value = id);
                safe("editarNome") && (safe("editarNome").value = btn.dataset.nome || "");
                safe("editarTipo") && (safe("editarTipo").value = btn.dataset.tipo || "");
                safe("editarValor") && (safe("editarValor").value = btn.dataset.valor || "");
                safe("editarDocumentos") && (safe("editarDocumentos").value = btn.dataset.documentos || "");
                modalEditarSacramento.showModal();
                return;
            }

            // caso seja evento (ou default) e exista modal de evento
            if (entity === "evento" && modalEditarEvento) {
                // preenche campos do modal do evento (ids: editar_id, editar_titulo, editar_tipo, editar_dia, editar_hora)
                const card = btn.closest(".card");
                safe("editar_id") && (safe("editar_id").value = id);
                // tenta preencher a partir do card se não houver data-attributes
                if (btn.dataset.titulo) {
                    safe("editar_titulo") && (safe("editar_titulo").value = btn.dataset.titulo);
                    safe("editar_tipo") && (safe("editar_tipo").value = btn.dataset.tipo || "");
                    safe("editar_dia") && (safe("editar_dia").value = btn.dataset.dia || "");
                    safe("editar_hora") && (safe("editar_hora").value = btn.dataset.hora || "");
                } else if (card) {
                    safe("editar_titulo") && (safe("editar_titulo").value = (card.querySelector(".titulo")?.textContent || "").trim());
                    safe("editar_tipo") && (safe("editar_tipo").value = (card.querySelector(".tipo")?.textContent || "").trim());
                    // remove labels "Dia da semana: " e "Horário: "
                    safe("editar_dia") && (safe("editar_dia").value = (card.querySelector(".dia")?.textContent || "").replace("Dia da semana: ", "").trim());
                    safe("editar_hora") && (safe("editar_hora").value = (card.querySelector(".hora")?.textContent || "").replace("Horário: ", "").trim());
                }
                modalEditarEvento.showModal();
                return;
            }

            // fallback: se modal especifico não existir, tenta detectar modal de sacramento por presença de campos
            if (modalEditarSacramento) {
                safe("editarId") && (safe("editarId").value = id);
                safe("editarNome") && (safe("editarNome").value = btn.dataset.nome || "");
                safe("editarTipo") && (safe("editarTipo").value = btn.dataset.tipo || "");
                safe("editarValor") && (safe("editarValor").value = btn.dataset.valor || "");
                safe("editarDocumentos") && (safe("editarDocumentos").value = btn.dataset.documentos || "");
                modalEditarSacramento.showModal();
            }
        });
    });

    // fecha modal editar evento se existir botão fechar
    if (btFecharModalEditarEvento && modalEditarEvento) {
        btFecharModalEditarEvento.addEventListener("click", () => modalEditarEvento.close());
    }

    // ---------- BOTÕES EXCLUIR (GENÉRICO) ----------
    document.querySelectorAll(".botaoExcluir").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const entity = btn.dataset.entity || "evento"; // entidade para construir a rota

            if (!confirm("Tem certeza que deseja excluir?")) return;

            const url = (entity === "sacramento") ? "deletarSacramento" : "excluirProgramacao";

            fetch(url, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(id)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // remove o card da tela
                    btn.closest(".card")?.remove();
                } else {
                    alert("Erro ao excluir: " + (data.message || "verifique o servidor"));
                }
            })
            .catch(err => {
                console.error("Erro:", err);
                alert("Erro na requisição. Veja console.");
            });
        });
    });

});
