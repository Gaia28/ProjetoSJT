<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        <section class="containerSacramentos">
            <h1>Sacramentos</h1>
            <p style="color: rgb(146, 15, 15);">Gerencie os sacramentos da igreja aqui.</p>

                <button class="botao" id="adicionarSacramento">Adicionar Sacramento</button>
                <dialog id="modalSacramento" class="modalEvento">
                    <p class="fecharModal">X</p>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome do Sacramento:</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Valor</label>
                            <input type="number" id="valor" name="valor" min="0.00" step="0.01" value="0.00">
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea id="descricao" name="descricao" required></textarea>
                        </div>
                        <button type="submit" class="botao">Salvar</button>
                    </form>
                </dialog>


        </section>
        <script src="public/assets/js/modal.js"></script>
</body>
</html>