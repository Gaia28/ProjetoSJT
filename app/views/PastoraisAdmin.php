<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
    <link rel="stylesheet" href="public/assets/css/base.css">
    <title>Pastorais</title>
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
        <h1>Pastorais</h1>
        <p >Gerencie as pastorais da paróquia aqui.</p>

        <button class="botao" id="adicionarPastoral">Adicionar Pastoral</button>

        <dialog id="modalAdicionarPastoral" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Cadastrar Nova Pastoral</h2>
            <form action="salvarPastoral" method="POST">
                <div class="form-group">
                    <label for="nome_pastoral">Nome da pastoral:</label>
                    <input type="text" id="nome_pastoral" name="nome_pastoral" required>
                </div>
                <div id="coordenadores">
                    <div class="form-group">
                        <label>Coordenador:</label>
                        <input type="text" name="coordenadores[0][nome]" placeholder="Nome" required>
                        <input type="text" name="coordenadores[0][telefone]" placeholder="Telefone">
                    </div>
                </div>
                <button type="button" class="botao" onclick="adicionarCoordenador('coordenadores')">+ Adicionar Coordenador</button>
                <br><br>
                <button class="botaoCadastro" type="submit">Cadastrar</button>
            </form>
        </dialog>

        <dialog id="modalEditarPastoral" class="modalEvento">
            <p class="fecharModal">X</p>
            <h2>Editar Pastoral</h2>
            <form action="editarPastoral" method="POST">
                <input type="hidden" id="editarPastoralId" name="id">
                <div class="form-group">
                    <label for="editarPastoralNome">Nome da pastoral:</label>
                    <input type="text" id="editarPastoralNome" name="nome_pastoral" required>
                </div>
                <div id="coordenadoresEditar"></div>
                <button type="button" class="botao" onclick="adicionarCoordenador('coordenadoresEditar')">+ Adicionar Coordenador</button>
                <br><br>
                <button class="botaoCadastro" type="submit">Salvar Alterações</button>
            </form>
        </dialog>
        
        <div class="cards">
            <?php if (!empty($pastorais)): ?>
                <?php foreach ($pastorais as $pastoral): ?>
                    <div class="card">
                        <h3><?= htmlspecialchars($pastoral['nome']) ?></h3>
                        <p>
                            <strong>Coordenadores:</strong> 
                            <?= htmlspecialchars($pastoral['coordenadores'] ?? 'Nenhum coordenador cadastrado') ?>
                        </p>
                        
                        <img src="public/assets/images/lixeira.png" alt="Excluir pastoral" class="botaoExcluir" data-id="<?= $pastoral['id'] ?>" data-entity="pastoral">
                        <button class="botaoEditar" data-id="<?= $pastoral['id'] ?>" data-entity="pastoral">Editar</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma pastoral cadastrada.</p>
            <?php endif; ?>
        </div>
    </section>

    <script src="public/assets/js/navegacao.js"></script>
    <script src="public/assets/js/modal.js"></script>

</body>
</html>