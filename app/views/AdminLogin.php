<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/Admin.css">
    <title>Administração</title>
</head>
<body>
    <main class="container" role="main">
        <header>
            <img src="../../public/assets/images/logo.PNG" alt="Logo do Santuário São Judas Tadeu">
            <h1>Administração <br>São Judas Tádeu</h1>
        </header>
        <section class="login-container" aria-label="Formulário de login administrativo">
            <form action="/admin/login" method="POST" autocomplete="username">
                <div class="form-group">
                    <label for="username">Usuário:</label>
                    <input type="text" id="username" name="username" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <button type="submit">Entrar</button>
            </form>
        </section>
    </main>
</body>
</html>