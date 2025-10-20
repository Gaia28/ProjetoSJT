<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
    <link rel="stylesheet" href="public/assets/css/base.css">
    <title>Sacramentos</title>
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
        <p>Gerencie os sacramentos da paróquia aqui.</p>

        <button class="botao" id="adicionarSacramento">Adicionar Sacramento</button>

        <dialog id="modalSacramento" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Cadastrar Sacramento</h2>
            <form action="sacramentos" method="POST">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="valor">Valor (taxa):</label>
                    <input type="text" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="documentos">Documentos Necessários:</label>
                    <textarea id="descricao" name="descricao" rows="4"></textarea>
                </div>
                <button class="botaoCadastro" type="submit">Cadastrar</button>
            </form>
        </dialog>

        <dialog id="modalEditarSacramento" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Editar Sacramento</h2>
            <form action="editarSacramento" method="POST">
                <input type="hidden" id="editarId" name="id">
                <div class="form-group">
                    <label for="editarNome">Nome:</label>
                    <input type="text" id="editarNome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="editarValor">Valor (taxa):</label>
                    <input type="text" id="editarValor" name="valor">
                </div>
                <div class="form-group">
                    <label for="editarDocumentos">Documentos Necessários:</label>
                    <textarea id="editarDocumentos" name="documentos" rows="4"></textarea>
                </div>
                <button class="botaoCadastro" type="submit">Salvar Alterações</button>
            </form>
        </dialog>

        <div class="cards">
            <?php if (!empty($sacramentos)): ?>
                <?php foreach ($sacramentos as $sacramento): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($sacramento['nome'] ?? '') ?></h3>
                        <p><strong>Valor:</strong> R$ <?= htmlspecialchars(number_format($sacramento['valor'] ?? 0, 2, ',', '.')) ?></p>
                        
                        <p class="descricao"><strong>Documentos:</strong> <?= htmlspecialchars($sacramento['descricao'] ?? 'Não informado') ?></p>
                        
                        <img src="public/assets/images/lixeira.png" 
                             alt="Excluir sacramento" 
                             class="botaoExcluir" 
                             data-id="<?= $sacramento['id'] ?>"
                             data-entity="sacramento">

                        <button class="botaoEditar"
                                data-id="<?= $sacramento['id'] ?>"
                                data-entity="sacramento"
                                data-nome="<?= htmlspecialchars($sacramento['nome'] ?? '') ?>"
                                data-valor="<?= htmlspecialchars($sacramento['valor'] ?? '') ?>"
                                data-documentos="<?= htmlspecialchars($sacramento['descricao'] ?? '') ?>">
                            Editar
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum sacramento cadastrado.</p>
            <?php endif; ?>
        </div>
    </section>

    <script src="public/assets/js/navegacao.js"></script>
    <script src="public/assets/js/modal.js"></script>
</body>
</html>