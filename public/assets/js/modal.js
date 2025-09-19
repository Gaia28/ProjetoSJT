document.addEventListener("DOMContentLoaded", () => {
    // ========================
    // Abrir/Fechar Modal "Adicionar Evento"
    // ========================
    const btAdcionarEvento = document.getElementById("adicionarEvento");
    const modal = document.getElementById("modalEvento");
    const btFecharModal = document.getElementById("modalEvento");

    if (btAdcionarEvento && modal) {
        btAdcionarEvento.addEventListener("click", () => modal.showModal());
    }

    if (btFecharModal && modal) {
        btFecharModal.addEventListener("click", () => modal.close());
    }

    // ========================
    // Editar Evento
    // ========================
    const botoesEditar = document.querySelectorAll(".botaoEditar");
    const modalEditar = document.getElementById("modalEditar");

    botoesEditar.forEach(botao => {
        botao.addEventListener("click", () => {
            const eventoDiv = botao.closest(".evento");

            document.getElementById("editar_id").value = botao.dataset.id;
            document.getElementById("btFecharModalEditar").addEventListener("click", () => modalEditar.close());
            document.getElementById("editar_titulo").value = eventoDiv.querySelector(".titulo").textContent;
            document.getElementById("editar_tipo").value = eventoDiv.querySelector(".tipo").textContent;
            document.getElementById("editar_dia").value = eventoDiv.querySelector(".dia").textContent.replace("Dia da semana: ", "");
            document.getElementById("editar_hora").value = eventoDiv.querySelector(".hora").textContent.replace("Horário: ", "");

            modalEditar.showModal();
        });
    });

    // ========================
    // Excluir Evento
    // ========================
    const botoesExcluir = document.querySelectorAll(".botaoExcluir");

    botoesExcluir.forEach(botao => {
        botao.addEventListener("click", () => {
            const id = botao.dataset.id;

            if (confirm("Tem certeza que deseja excluir este evento?")) {
                fetch("excluirProgramacao", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + encodeURIComponent(id)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Evento excluído com sucesso!");
                        botao.closest(".evento").remove(); 
                    } else {
                        alert("Erro: " + (data.message || "Não foi possível excluir."));
                    }
                })
                .catch(err => console.error("Erro na requisição:", err));
            }
        });
    });
});
