<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Eventos</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
</head>
<body>
    <header class="header">
        <div class="circle"><img src="public/assets/images/logo.PNG" alt="Logo do Santuário"></div>
        <p>Paróquia Santuário São Judas Tadeu</p>
        <nav><a href="homeAdmin">Voltar</a></nav>
    </header>

    <section class="container">
        <h1>Painel de Eventos</h1>
        <p>Adicione e gerencie os eventos especiais da paróquia.</p>

        <button class="botao" id="adicionarEventoBtn">Adicionar Novo Evento</button>

        <dialog id="modalAdicionarEvento" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Cadastrar Novo Evento</h2>
            <form action="salvarEvento" method="POST" enctype="multipart/form-data">
                <div class="form-group"><label for="nome">Nome do Evento:</label><input type="text" id="nome" name="nome" required></div>
                <div class="form-group-row">
                    <div class="form-group"><label for="data_evento">Data:</label><input type="date" id="data_evento" name="data_evento" required></div>
                    <div class="form-group"><label for="horario">Horário:</label><input type="time" id="horario" name="horario" required></div>
                </div>
                <div class="form-group"><label for="local">Local:</label><input type="text" id="local" name="local" required></div>
                <div class="form-group">
                    <label for="imagem">Imagem de Divulgação (Opcional):</label>
                    <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png" onchange="previewImagem(event)">
                    <img id="imagemPreview" alt="Pré-visualização da imagem"/>
                </div>
                <div class="form-group"><label for="descricao">Descrição / Detalhes:</label><textarea id="descricao" name="descricao" rows="5"></textarea></div>
                <button type="submit" class="botao">Salvar Evento</button>
            </form>
        </dialog>

        <div class="cards">
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $evento): ?>
                    <div class="card card-evento">
                        <?php if (!empty($evento['imagem'])): ?>
                            <img class="card-evento-img" src="data:image/jpeg;base64,<?= base64_encode($evento['imagem']) ?>" alt="<?= htmlspecialchars($evento['nome']) ?>">
                        <?php else: ?>
                            <div class="card-evento-img-placeholder"><span>Sem Imagem</span></div>
                        <?php endif; ?>
                        <div class="card-evento-body">
                            <h3><?= htmlspecialchars($evento['nome']) ?></h3>
                            <p class="evento-info">
                                <strong>Data:</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($evento['data_evento']))) ?><br>
                                <strong>Horário:</strong> <?= htmlspecialchars(date('H:i', strtotime($evento['horario']))) ?><br>
                                <strong>Local:</strong> <?= htmlspecialchars($evento['local']) ?>
                            </p>
                            <?php if (!empty($evento['descricao'])): ?>
                                <p class="descricao"><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum evento cadastrado no momento.</p>
            <?php endif; ?>
        </div>
    </section>

    <script>
        const modal = document.getElementById('modalAdicionarEvento');
        const preview = document.getElementById('imagemPreview');
        
        document.getElementById('adicionarEventoBtn').addEventListener('click', () => {
            modal.querySelector('form').reset();
            preview.style.display = 'none';
            preview.setAttribute('src', '#');
            modal.showModal();
        });

        modal.querySelector('.fecharModal').addEventListener('click', () => modal.close());

        function previewImagem(event) {
            const file = event.target.files[0];
            if (file) {
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(file);
                preview.onload = () => URL.revokeObjectURL(preview.src);
            } else {
                preview.style.display = 'none';
                preview.setAttribute('src', '#');
            }
        }
    </script>
</body>
</html>