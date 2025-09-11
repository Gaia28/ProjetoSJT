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

                    <form method="post" action="#" class="formEvento">
                        <h2>Adicionar Evento</h2>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" required>

                        <label for="dia da semana">Dia da Semana:</label>
                        <input type="text" id="dia da semana" name="dia da semana" required>

                        <label for="hora">Hora:</label>
                        <input type="time" id="hora" name="hora" required> 
                        <div class="botoes">
                            <button class="botao" type="submit">Salvar</button>
                            <button class="botao" type="button" id="fecharModal">Cancelar</button>
                        </div>
                    </form>

                </dialog>
                <div class="eventos">
                    <div class="evento">
                        <h3>Evento 1</h3>
                        <p>Data: 10/10/2024</p>
                        <p>Descrição: Descrição do evento 1.</p>
                        <button class="botaoEditar ">Editar</button>
                    </div>
                    <div class="evento">
                        <h3>Evento 2</h3>
                        <p>Data: 15/10/2024</p>
                        <p>Descrição: Descrição do evento 2.</p>
                        <button class="botaoEditar">Editar</button>
                    </div>
                    <div class="evento">
                        <h3>Evento 3</h3>
                        <p>Data: 20/10/2024</p>
                        <p>Descrição: Descrição do evento 3.</p>
                        <button class="botaoEditar">Editar</button>
                    </div>
                    <div class="evento">
                        <h3>Evento 4</h3>
                        <p>Data: 20/10/2024</p>
                        <p>Descrição: Descrição do evento 3.</p>
                        <button class="botaoEditar">Editar</button>
                    </div>
                    
                </div>
                

        </section>

        <script src="public/assets/js/modal.js"></script>

</body>
</html>