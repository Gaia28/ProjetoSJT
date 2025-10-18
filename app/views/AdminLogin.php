<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/Admin.css">
    <title>Administração</title>
</head>
<body>
    <main class="container" role="main">
        <header>
            <img src="public/assets/images/logo.PNG" alt="Logo do Santuário São Judas Tadeu">
            <h1>Administração <br>São Judas Tádeu</h1>
        </header>
        <section class="login-container" aria-label="Formulário de login administrativo">

            <form action="admin" method="POST" autocomplete="username">
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



<div class="box-admin">
    <h2 class="titulo" style="--i: 17; --j: 0;">entrar</h2>

    <form action="admin" method="POST" autocomplete="username">
                <div class="form-group" style="--i: 18; --j: 1;">
                    <label for="username">Usuário:</label>
                    <input type="text" id="username" name="username" required autocomplete="username">
                </div>
                <div class="form-group" style="--i: 19; --j: 2;">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <button type="submit" class="entrar" style="--i: 20; --j: 3;">Entrar</button>
            </form>
</div>