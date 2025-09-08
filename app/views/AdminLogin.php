<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/Admin.css">
    <title>Administração</title>
</head>
<body>
    <img src="../../public/assets/images/logo.PNG" alt="logo">
    <h1>Administração SJT</h1>
    <div class="login-container">
        <form action="/admin/login" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

    </div>
</html>