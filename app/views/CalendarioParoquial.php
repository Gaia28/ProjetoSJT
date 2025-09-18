<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
    <title>Document</title>
</head>
<body>
      <header class="header">
            <div class="circle">
                <img src="public/assets/images/logo.PNG" alt="Logo do Santuário">
            </div>
            <p>Paróquia Santuário São Judas Tadeu</p>
            <nav>
                <a href="#">Voltar</a>
            </nav>
        </header>

        <section class="containerCalendario">
            <h1>Calendário Paroquial</h1>
            <p style="color: rgb(146, 15, 15);">Gerencie o calendário da igreja aqui.</p>

                <button class="botao" id="adicionarEvento">Adicionar Evento</button>
                <dialog id="modalEvento">

                <form action="calendarioParoquial" method="POST">
                    <div class="form-group">
                        <label for="titulo">Título do evento:</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de evento:</label>
                        <select name="tipo" id="tipo" required>
                            <option value="Missa">Missa</option>
                            <option value="Grupo de oração">Grupo de oração</option>
                            <option value="Louvor e Adoração">Louvor e Adoração</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dia_semana">Dia da semana:</label>
                        <select name="dia_semana" id="dia_semana" required>
                            <option value="Domingo">Domingo</option>
                            <option value="Segunda">Segunda</option>
                            <option value="Terça">Terça</option>
                            <option value="Quarta">Quarta</option>
                            <option value="Quinta">Quinta</option>
                            <option value="Sexta">Sexta</option>
                            <option value="Sábado">Sábado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="horario">Horário:</label>
                        <input type="time" id="horario" name="horario" required>
                    </div>

                    <button type="submit">Cadastrar</button>
            </form>
                </dialog>
               <div class="eventos">
    <?php if (!empty($eventos)): ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="evento">
                <h3><?= htmlspecialchars($evento['titulo']) ?></h3>
                <p><?= htmlspecialchars($evento['tipo']) ?></p>
                <p>Dia da semana: <?= htmlspecialchars($evento['dia_semana']) ?></p>
                <p>Horário: <?= htmlspecialchars($evento['horario']) ?></p>
                <p>Descrição: <?= htmlspecialchars($evento['descricao'] ?? 'Sem descrição') ?></p>
                <button class="botaoEditar" data-id="<?= $evento['id'] ?>">Editar</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhuma programação cadastrada.</p>
    <?php endif; ?>
</div>
                

        </section>
    <script src="public/assets/js/navegacao.js"></script>
    <script src="public/assets/js/modal.js"></script>

</body>
</html>