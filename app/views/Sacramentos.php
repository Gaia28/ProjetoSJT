<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacramentos</title>
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
</head>
<body>
    <header class="header">
        <div class="circle">
            <img src="public/assets/images/logo.PNG" alt="Logo do Santuário">
        </div>
        <p>Paróquia Santuário São Judas Tadeu</p>
        <nav>
            <a href="homeAdmin">Voltar</a>
        </nav>
    </header>

    <section class="container">
        <h1>Sacramentos</h1>
        <p class="subtitulo">Gerencie os sacramentos da igreja aqui.</p>

        <!-- Botão abrir modal -->
        <button class="botao" id="adicionarSacramento">Adicionar Sacramento</button>

        <!-- Modal de cadastro -->
        <dialog id="modalSacramento" class="modalEvento">
            <p class="fecharModal">X</p>
            <form action="sacramentos" method="POST">
                <div class="form-group">
                    <label for="nome">Nome do Sacramento:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" min="0.00" step="0.01" value="0.00">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" required></textarea>
                </div>
                <button type="submit" class="botao">Salvar</button>
            </form>
        </dialog>

        <dialog id="modalEditarSacramento" class="modalSacramento">
    <p class="fecharModal" id="fecharEditar">X</p>
    <h2>Editar Sacramento</h2>
    <form id="formEditarSacramento" method="POST">
        <input type="hidden" name="id" id="editarId">

        <label for="editarNome">Nome:</label>
        <input type="text" name="nome" id="editarNome" required>

        <label for="editarTipo">Tipo:</label>
        <input type="text" name="tipo" id="editarTipo" required>

        <label for="editarValor">Valor:</label>
        <input type="number" name="valor" id="editarValor" required>

        <label for="editarDocumentos">Documentos:</label>
        <textarea name="documentos" id="editarDocumentos" rows="3"></textarea>

        <button type="submit" class="botao">Salvar Alterações</button>
    </form>
</dialog>

        <!-- Cards -->
        <div class="cards">
           <?php foreach ($sacramentos as $sacramento): ?>
  <div class="card">
    <img src="public/assets/images/lixeira.png" alt="Excluir" 
         class="botaoExcluir" 
         data-id="<?= $sacramento['id'] ?>" 
         data-entity="sacramento">

    <h3 class="titulo"><?= htmlspecialchars($sacramento['nome']) ?></h3>
    <p class="valor">Valor: R$ <?= number_format($sacramento['valor'], 2, ',', '.') ?></p>
    <p class="descricao"><?= htmlspecialchars($sacramento['descricao']) ?></p>

    <!-- botão editar COM dados para preencher o modal -->
    <button class="botaoEditar"
        data-id="<?= $sacramento['id'] ?>"
        data-nome="<?= htmlspecialchars($sacramento['nome']) ?>"
        data-tipo="<?= htmlspecialchars($sacramento['tipo'] ?? '') ?>"
        data-valor="<?= $sacramento['valor'] ?>"
        data-documentos="<?= htmlspecialchars($sacramento['documentos'] ?? $sacramento['descricao'] ?? '') ?>"
        data-entity="sacramento">
      Editar
    </button>
  </div>
<?php endforeach; ?>

    </section>

    <script src="public/assets/js/modal.js"></script>
</body>
</html>
