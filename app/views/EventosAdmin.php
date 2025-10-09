<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Eventos</title>

    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="circle"><img src="public/assets/images/logo.PNG" alt="Logo do Santuário"></div>
        <p>Paróquia Santuário São Judas Tadeu</p>
        <nav><a href="homeAdmin">Voltar</a></nav>
    </header>

    <section class="container">
        <h1>Painel de Eventos</h1>
        <p style="color: rgb(146, 15, 15);">Adicione e gerencie os eventos especiais da paróquia.</p>

        <button class="botao" id="adicionarEventoBtn">Adicionar Novo Evento</button>

        <dialog id="modalAdicionarEvento" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Cadastrar Novo Evento</h2>
            <form action="salvarEvento" method="POST" enctype="multipart/form-data">
                <div class="form-group"><label for="nome">Nome do Evento:</label><input type="text" id="nome"
                        name="nome" required></div>
                <div class="form-group-row">
                    <div class="form-group"><label for="data_evento">Data:</label><input type="date" id="data_evento"
                            name="data_evento" required></div>
                    <div class="form-group"><label for="horario">Horário:</label><input type="time" id="horario"
                            name="horario" required></div>
                </div>
                <div class="form-group"><label for="local">Local:</label><input type="text" id="local" name="local"
                        required></div>
                <div class="form-group">
                    <label for="imagem">Imagem de Divulgação (Opcional):</label>
                    <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png"
                        onchange="previewImagem(event)">
                    <img id="imagemPreview" alt="Pré-visualização da imagem" />
                </div>
                <div class="form-group"><label for="descricao">Descrição / Detalhes:</label><textarea id="descricao"
                        name="descricao" rows="5"></textarea></div>
                <button type="submit" class="botao">Salvar Evento</button>
            </form>
            <form action="salvarEvento" method="POST" enctype="multipart/form-data">
            </form>
        </dialog>

        <dialog id="modalEditarEventoAdmin" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Editar Evento</h2>
            <form action="editarEventoAdmin" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="editar_id" name="id">
                <div class="form-group"><label for="editar_nome">Nome:</label><input type="text" id="editar_nome"
                        name="nome" required></div>
                <div class="form-group-row">
                    <div class="form-group"><label for="editar_data">Data:</label><input type="date" id="editar_data"
                            name="data_evento" required></div>
                    <div class="form-group"><label for="editar_horario">Horário:</label><input type="time"
                            id="editar_horario" name="horario" required></div>
                </div>
                <div class="form-group"><label for="editar_local">Local:</label><input type="text" id="editar_local"
                        name="local" required></div>
                <div class="form-group">
                    <label for="editar_imagem">Substituir Imagem:</label>
                    <input type="file" id="editar_imagem" name="imagem" accept="image/jpeg, image/png"
                        onchange="previewImagemEditar(event)">
                    <img id="imagemPreviewEditar" alt="Preview"
                        style="display: none; max-width: 100%; margin-top: 10px;" />
                </div>
                <div class="form-group"><label for="editar_descricao">Descrição:</label><textarea id="editar_descricao"
                        name="descricao" rows="5"></textarea></div>
                <button type="submit" class="botao">Salvar Alterações</button>
            </form>
        </dialog>

        <h2 class="titulo-secao">Eventos Cadastrados</h2>
        <div class="cards" id="cardsContainer">
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $evento): ?>
                    <div class="card card-evento" data-evento-id="<?= $evento['id'] ?>">
                        <?php if (!empty($evento['imagem'])): ?>
                            <img class="card-evento-img" src="data:image/jpeg;base64,<?= base64_encode($evento['imagem']) ?>"
                                alt="<?= htmlspecialchars($evento['nome']) ?>">
                        <?php else: ?>
                            <div class="card-evento-img-placeholder"><span>Sem Imagem</span></div>
                        <?php endif; ?>
                        <div class="card-evento-body">
                            <h3 style="color:antiquewhite;"><?= htmlspecialchars($evento['nome']) ?></h3>
                            <p class="evento-info">
                                <strong>Data:</strong>
                                <?= htmlspecialchars(date('d/m/Y', strtotime($evento['data_evento']))) ?><br>
                                <strong>Horário:</strong>
                                <?= htmlspecialchars(date('H:i', strtotime($evento['horario']))) ?><br>
                                <strong>Local:</strong> <?= htmlspecialchars($evento['local']) ?>
                            </p>
                            <?php if (!empty($evento['descricao'])): ?>
                                <p class="descricao"><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer">
                            <img src="public/assets/images/lixeira.png" alt="Excluir" class="botaoExcluir"
                                data-id="<?= $evento['id'] ?>">
                            <button class="botao botaoEditar" data-id="<?= $evento['id'] ?>"
                                data-nome="<?= htmlspecialchars($evento['nome']) ?>"
                                data-data_evento="<?= htmlspecialchars($evento['data_evento']) ?>"
                                data-horario="<?= htmlspecialchars($evento['horario']) ?>"
                                data-local="<?= htmlspecialchars($evento['local']) ?>"
                                data-descricao="<?= htmlspecialchars($evento['descricao']) ?>">
                                Editar
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p id="mensagemSemEventos">Nenhum evento cadastrado.</p>
            <?php endif; ?>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const safe = id => document.getElementById(id);

            // --- Lógica para Abrir e Fechar os Modais ---
            const modalAdicionar = safe('modalAdicionarEvento');
            const modalEditar = safe('modalEditarEventoAdmin');

            if (modalAdicionar) {
                safe('adicionarEventoBtn').addEventListener('click', () => modalAdicionar.showModal());
                modalAdicionar.querySelector('.fecharModal').addEventListener('click', () => modalAdicionar.close());
            }
            if (modalEditar) {
                modalEditar.querySelector('.fecharModal').addEventListener('click', () => modalEditar.close());
            }

            // --- Lógica do Botão Editar ---
            document.querySelectorAll(".botaoEditar").forEach(btn => {
                btn.addEventListener("click", () => {
                    // Preenche o formulário de edição com os dados do botão clicado
                    safe('editar_id').value = btn.dataset.id || '';
                    safe('editar_nome').value = btn.dataset.nome || '';
                    safe('editar_data').value = btn.dataset.data_evento || '';
                    safe('editar_horario').value = btn.dataset.horario || '';
                    safe('editar_local').value = btn.dataset.local || '';
                    safe('editar_descricao').value = btn.dataset.descricao || '';

                    // Limpa o campo de imagem e esconde o preview
                    safe('editar_imagem').value = '';
                    const preview = safe('imagemPreviewEditar');
                    if (preview) preview.style.display = 'none';

                    // Abre o modal de edição
                    if (modalEditar) modalEditar.showModal();
                });
            });

            // --- Lógica do Botão Excluir ---
            document.querySelectorAll(".botaoExcluir").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.dataset.id;
                    if (!confirm("Tem certeza que deseja excluir este evento?")) return;

                    fetch('excluirEvento', {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + encodeURIComponent(id)
                    })
                        .then(r => r.json().catch(() => ({ success: false, message: "Resposta inválida" })))
                        .then(data => {
                            if (data.success) {
                                // Encontra o card e o remove da tela
                                const cardToRemove = document.querySelector(`.card[data-evento-id='${id}']`);
                                if (cardToRemove) cardToRemove.remove();
                            } else {
                                alert("Erro ao excluir: " + (data.message || "Tente novamente"));
                            }
                        })
                        .catch(err => alert("Erro na requisição. Veja o console."));
                });
            });
        });

        // Funções de preview de imagem (continuam globais para o onchange funcionar)
        function previewImagem(event) {
            const preview = document.getElementById('imagemPreview');
            if (event.target.files[0]) {
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(event.target.files[0]);
            }
        }
        function previewImagemEditar(event) {
            const preview = document.getElementById('imagemPreviewEditar');
            if (event.target.files[0]) {
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(event.target.files[0]);
            }
        }
    </script>
</body>

</html>