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

                <!-- Campo coordenadores dinâmicos -->
                <div id="coordenadores">
                    <div class="form-group">
                        <label>Coordenador:</label>
                        <input type="text" name="coordenadores[0][nome]" placeholder="Nome" required>
                        <input type="text" name="coordenadores[0][telefone]" placeholder="Telefone">
                    </div>
                </div>
                <button type="button" class="botao" onclick="adicionarCoordenador()">+ Adicionar Coordenador</button>

                <!-- Campo encontros dinâmicos -->
                <div id="encontros">
                    <div class="form-group">
                        <label>Dia:</label>
                        <select name="encontros[0][dia_semana]">
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
                        <input type="time" name="encontros[0][horario]">
                    </div>
                </div>
                <button type="button" class="botao" onclick="adicionarEncontro()">+ Adicionar Encontro</button>

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

                        <p><strong>Encontros:</strong></p>
                        <?php if (!empty($pastoral['encontros'])): ?>
                            <ul>
                                <?php foreach ($pastoral['encontros'] as $encontro): ?>
                                    <li><?= htmlspecialchars($encontro['dia_semana']) ?> - <?= htmlspecialchars($encontro['horario']) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>Sem encontros definidos.</p>
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
    let countEncontro = 1;

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

    function adicionarEncontro() {
        const div = document.getElementById("encontros");
        div.insertAdjacentHTML("beforeend", `
            <div class="form-group">
                <label>Dia:</label>
                <select name="encontros[${countEncontro}][dia_semana]">
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
                <input type="time" name="encontros[${countEncontro}][horario]">
            </div>
        `);
        countEncontro++;
    }
    </script>
</body>
</html>
