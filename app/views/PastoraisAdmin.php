<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
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
        <p style="color: rgb(146, 15, 15);">Gerencie as pastorais da paróquia aqui.</p>

        <!-- Botão para abrir modal -->
        <button class="botao" id="adicionarPastoral">Adicionar Pastoral</button>

        <!-- Modal de adicionar pastoral -->
        <dialog id="modalAdicionarPastoral" class="modalEvento">
            <p class="fecharModal">X</p>

            <form action="salvarPastoral" method="POST">
                <div class="form-group">
                    <label for="nome_pastoral">Nome da pastoral:</label>
                    <input type="text" id="nome_pastoral" name="nome_pastoral" required>
                </div>

                <!-- Coordenadores dinâmicos -->
                <div id="coordenadores">
                    <div class="form-group">
                        <label>Coordenador:</label>
                        <input type="text" name="coordenadores[0][nome]" placeholder="Nome" required>
                        <input type="text" name="coordenadores[0][telefone]" placeholder="Telefone">
                    </div>
                </div>
                <button type="button" class="botao" onclick="adicionarCoordenador()">+ Adicionar Coordenador</button>

                <button type="submit">Cadastrar</button>
            </form>
        </dialog>

        <!-- Cards das pastorais -->
        <div class="cards">
            <?php if (!empty($pastorais)): ?>
                <?php foreach ($pastorais as $pastoral): ?>
                    <div class="card">
                        <img src="public/assets/images/lixeira.png" alt="Excluir pastoral" class="botaoExcluir" data-id="<?= $pastoral['id'] ?>">
                        <h3 class="titulo"><?= htmlspecialchars($pastoral['nome']) ?></h3>

                        <p><strong>Coordenadores:</strong></p>
                        <?php if (!empty($pastoral['coordenadores'])): ?>
                            <ul>
                                <?php foreach ($pastoral['coordenadores'] as $coord): ?>
                                    <li><?= htmlspecialchars($coord['nome']) ?> (<?= htmlspecialchars($coord['telefone'] ?? 'Sem telefone') ?>)</li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>Sem coordenadores cadastrados.</p>
                        <?php endif; ?>

                        <button class="botaoEditar" data-id="<?= $pastoral['id'] ?>">Editar</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma pastoral cadastrada.</p>
            <?php endif; ?>
        </div>
    </section>

    <script src="public/assets/js/navegacao.js"></script>
    <script src="public/assets/js/modal.js"></script>

    <script>
    let countCoord = 1;

    function adicionarCoordenador() {
        const div = document.getElementById("coordenadores");
        div.insertAdjacentHTML("beforeend", `
            <div class="form-group">
                <label>Coordenador:</label>
                <input type="text" name="coordenadores[${countCoord}][nome]" placeholder="Nome" required>
                <input type="text" name="coordenadores[${countCoord}][telefone]" placeholder="Telefone">
            </div>
        `);
        countCoord++;
    }
    </script>
</body>
</html>
